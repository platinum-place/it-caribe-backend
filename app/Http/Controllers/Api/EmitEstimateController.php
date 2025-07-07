<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Cotizaciones;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmitEstimateController extends Controller
{
    public function show(int $id)
    {
        $libreria = new Cotizaciones;
        $quote = $libreria->getRecord('Quotes', $id);

        if (! $quote) {
            abort(404, 'Cotización no encontrada');
        }

        // Obtener opciones de seguros
        $insuranceOptions = collect($quote->getLineItems())
            ->filter(fn ($item) => $item->getNetTotal() > 0)
            ->mapWithKeys(fn ($item) => [
                $item->getProduct()->getEntityId() => $item->getProduct()->getLookupLabel().' (RD$'.number_format($item->getNetTotal(), 2).')',
            ])
            ->toArray();

        $customerName = $quote->getFieldValue('Nombre').' '.$quote->getFieldValue('Apellido');
        $customerDocument = $quote->getFieldValue('RNC_C_dula');

        return view('emit-estimate-form', compact(
            'id',
            'insuranceOptions',
            'customerName',
            'customerDocument'
        ));
    }

    public function store(Request $request, int $id)
    {
        // Validar datos del formulario
        $request->validate([
            'planid' => 'required|string',
            'acuerdo' => 'required|accepted',
            'documentos' => 'required|array|min:1',
            'documentos.*' => 'file|mimes:pdf,jpg,jpeg,png,gif|max:10240',
        ], [
            'planid.required' => 'Debe seleccionar una aseguradora.',
            'acuerdo.required' => 'Debe aceptar el acuerdo.',
            'acuerdo.accepted' => 'Debe aceptar el acuerdo.',
            'documentos.required' => 'Debe adjuntar al menos un documento.',
            'documentos.min' => 'Debe adjuntar al menos un documento.',
            'documentos.*.file' => 'El archivo debe ser válido.',
            'documentos.*.mimes' => 'Solo se permiten archivos PDF e imágenes.',
            'documentos.*.max' => 'El archivo no puede ser mayor a 10MB.',
        ]);

        try {
            $libreria = new Cotizaciones;
            $cotizacion = $libreria->getRecord('Quotes', $id);

            if (! $cotizacion) {
                return back()->withErrors(['error' => 'Cotización no encontrada.']);
            }

            // Actualizar cotización
            $libreria->actualizar_cotizacion($cotizacion, $request->planid);

            // Procesar archivos subidos
            foreach ($request->file('documentos') as $documento) {
                $libreria->uploadAttachment('Quotes', $id, $documento->getRealPath());
            }

            // Redirigir a la página de emisión de Filament
            return redirect()->to('/admin/emit/'.$id)
                ->with('success', 'Cotización emitida exitosamente.');

        } catch (\Exception $e) {
            Log::error('Error emitiendo cotización: '.$e->getMessage());

            return back()->withErrors(['error' => 'Error procesando la cotización: '.$e->getMessage()]);
        }
    }

    public function getDownloadUrl(int $id, string $planId)
    {
        return route('filament.resources.estimate.condicionado', $planId);
    }
}

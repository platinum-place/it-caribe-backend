<?php

namespace App\Http\Controllers;

use App\Helpers\Zoho;
use App\Models\QuoteVehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(QuoteVehicle $quoteVehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteVehicle $quoteVehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteVehicle $quoteVehicle)
    {
        //
    }

    public function download(QuoteVehicle $quoteVehicle)
    {
        $libreria = new Zoho;
        // obtener datos de la cotizacion
        $cotizacion = $libreria->getRecord('Quotes', $quoteVehicle->quote->id_crm);

//        return view('quote-vehicles.download', [
//            'quoteVehicle' => $quoteVehicle,
//            'cotizacion' => $cotizacion,
//            'libreria' => $libreria,
//        ]);

        $pdf = Pdf::loadView('quote-vehicles.download', [
            'quoteVehicle' => $quoteVehicle,
            'cotizacion' => $cotizacion,
            'libreria' => $libreria,
            'name' => "Cotización No. " . $cotizacion->getFieldValue('Quote_Number'),
        ]);

        $pdf->setPaper('A4');

        return $pdf->stream('Cotización No' . $cotizacion->getFieldValue('Quote_Number') . '.pdf');
    }
}

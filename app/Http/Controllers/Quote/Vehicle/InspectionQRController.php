<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\ValidateInspectionRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InspectionQRController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ValidateInspectionRequest $request)
    {
        $data = $request->all();

        //        $quoteVehicleLine = QuoteVehicleLine::find($data['cotz_id']);

        $qr = base64_encode(QrCode::format('svg')
            ->size(80)
            ->generate("https://gruponobesrl.zcrmportals.com/portal/GrupoNobeSRL/crm/tab/Quotes/{$request->get('cotz_id')}"));

        return response()->json([
            'QR' => $qr,
        ]);
    }
}

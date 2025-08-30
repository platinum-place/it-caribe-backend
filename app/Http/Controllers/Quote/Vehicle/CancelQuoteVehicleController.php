<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\CancelQuoteVehicleRequest;
use App\Models\QuoteVehicleLine;
use old\Modules\Quote\app\Enums\QuoteStatusEnum;

class CancelQuoteVehicleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CancelQuoteVehicleRequest $request)
    {
        $data = $request->all();

        $quoteVehicleLine = QuoteVehicleLine::findOrFail($data['IdCotizacion']);

        $quoteVehicleLine?->quoteVehicle->quote->update([
            'quote_status_id' => QuoteStatusEnum::CANCELLED->value,
        ]);

        return response()->json(['Error' => '']);
    }
}

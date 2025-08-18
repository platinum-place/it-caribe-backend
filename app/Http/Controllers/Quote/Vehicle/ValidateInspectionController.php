<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Enums\Quote\QuoteStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\ValidateInspectionRequest;
use App\Models\Quote\Vehicle\QuoteVehicleLine;
use Illuminate\Http\Request;

class ValidateInspectionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ValidateInspectionRequest $request)
    {
        $data = $request->all();

        $quoteVehicleLine = QuoteVehicleLine::find($data['cotz_id']);

        $quoteVehicleLine->quoteVehicle->quote->update([
            'quote_status_id' => QuoteStatusEnum::CHECKED->value,
        ]);

        return response()->json(['Error' => '']);
    }
}

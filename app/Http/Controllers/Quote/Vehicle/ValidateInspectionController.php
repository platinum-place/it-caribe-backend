<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\ValidateInspectionRequest;
use App\Models\QuoteVehicleLine;
use Modules\Quote\Enums\QuoteStatusEnum;

class ValidateInspectionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ValidateInspectionRequest $request)
    {
        $data = $request->all();

        $quoteVehicleLine = QuoteVehicleLine::findOrFail($data['cotz_id']);

        $quoteVehicleLine?->quoteVehicle->quote->update([
            'quote_status_id' => QuoteStatusEnum::CHECKED->value,
        ]);

        return response()->json(['Error' => '']);
    }
}

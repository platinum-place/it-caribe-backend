<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\IssueQuoteVehicleRequest;
use App\Models\QuoteVehicleLine;
use Carbon\Carbon;
use Modules\Quote\Enums\QuoteLineStatusEnum;
use Modules\Quote\Enums\QuoteStatusEnum;

class IssueQuoteVehicleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IssueQuoteVehicleRequest $request)
    {
        $data = $request->all();

        $quoteVehicleLine = QuoteVehicleLine::findOrFail($data['cotzid']);

        $quoteVehicleLine?->quoteLine->update([
            'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
        ]);

        $quoteVehicleLine?->quoteVehicle->quote->update([
            'end_date' => Carbon::createFromFormat('d/m/Y', $data['FechaVencimiento'])?->format('Y-m-d'),
            'quote_status_id' => QuoteStatusEnum::APPROVED->value,
        ]);

        return response()->json(['Error' => '']);
    }
}

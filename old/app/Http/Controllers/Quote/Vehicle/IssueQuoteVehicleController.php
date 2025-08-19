<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Enums\Quote\QuoteStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\IssueQuoteVehicleRequest;
use App\Models\Quote\Vehicle\QuoteVehicleLine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IssueQuoteVehicleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IssueQuoteVehicleRequest $request)
    {
        $data = $request->all();

        $quoteVehicleLine = QuoteVehicleLine::find($data['cotzid']);

        $quoteVehicleLine->quoteLine->update([
            'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
        ]);

        $quoteVehicleLine->quoteVehicle->quote->update([
            'end_date' => Carbon::createFromFormat('d/m/Y', $data['FechaVencimiento'])?->format('Y-m-d'),
            'quote_status_id' => QuoteStatusEnum::APPROVED->value,
        ]);

        return response()->json(['Error' => '']);
    }
}

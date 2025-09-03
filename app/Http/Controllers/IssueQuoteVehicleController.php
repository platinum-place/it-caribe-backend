<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueQuoteVehicleRequest;
use Carbon\Carbon;
use Modules\Domain\Quotations\Core\Enums\QuoteLineStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Infrastructure\Quotations\Products\Vehicle\Persistence\Models\QuoteVehicleLine;

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

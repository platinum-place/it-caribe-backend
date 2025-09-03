<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelQuoteVehicleRequest;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Infrastructure\Quotations\Products\Vehicle\Persistence\Models\QuoteVehicleLine;

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

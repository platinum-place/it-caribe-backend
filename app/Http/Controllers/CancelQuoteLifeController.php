<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueQuoteLifeRequest;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Infrastructure\Quotations\Products\Life\Persistence\Models\QuoteLifeLine;

class CancelQuoteLifeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IssueQuoteLifeRequest $request)
    {
        $data = $request->all();

        $quoteLifeLine = QuoteLifeLine::findOrFail($data['Identificador']);

        $quoteLifeLine?->quoteLife->quote->update([
            'quote_status_id' => QuoteStatusEnum::CANCELLED->value,
        ]);

        return response()->json(['Error' => '']);
    }
}

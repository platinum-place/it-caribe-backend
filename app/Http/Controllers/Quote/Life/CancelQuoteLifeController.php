<?php

namespace App\Http\Controllers\Quote\Life;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Life\IssueQuoteLifeRequest;
use App\Models\QuoteLifeLine;
use Modules\Quote\Enums\QuoteStatusEnum;

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

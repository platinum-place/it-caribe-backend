<?php

namespace App\Http\Controllers\Quote\Life;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Enums\Quote\QuoteStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Life\IssueQuoteLifeRequest;
use App\Models\Quote\Life\QuoteLifeLine;

class IssueQuoteLifeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IssueQuoteLifeRequest $request)
    {
        $data = $request->all();

        $quoteLifeLine = QuoteLifeLine::findOrFail($data['Identificador']);

        $quoteLifeLine?->quoteLine->update([
            'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
        ]);

        $quoteLifeLine?->quoteLife->quote->update([
            'end_date' => now()->addYear(),
            'quote_status_id' => QuoteStatusEnum::APPROVED->value,
        ]);

        return response()->json(['Error' => '']);
    }
}

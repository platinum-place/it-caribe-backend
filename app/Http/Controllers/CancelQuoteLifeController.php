<?php

namespace App\Http\Controllers;

use App\Enums\QuoteStatusEnum;
use App\Http\Requests\IssueQuoteLifeRequest;
use App\Models\QuoteLifeLine;

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

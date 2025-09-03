<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueQuoteLifeRequest;
use Modules\Domain\Quotations\Core\Enums\QuoteLineStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Infrastructure\Quotations\Products\Life\Persistence\Models\QuoteLifeLine;

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

<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\ValidateInspectionRequest;
use App\Models\QuoteVehicleLine;

class PhotosController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ValidateInspectionRequest $request)
    {
        $data = $request->all();

        $quoteVehicleLine = QuoteVehicleLine::findOrFail($data['cotz_id']);

        $attachments = $quoteVehicleLine?->quoteVehicle->quote->attachments;

        $response = [];

        foreach ($attachments as $attachment) {
            $response[] = [pathinfo($attachment, PATHINFO_FILENAME) => base64_encode(\Storage::get($attachment))];
        }

        return response()->json($response);
    }
}

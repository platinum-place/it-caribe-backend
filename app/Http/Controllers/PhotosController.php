<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateInspectionRequest;
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

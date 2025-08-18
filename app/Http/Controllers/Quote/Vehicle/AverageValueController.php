<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AverageValueController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'valorMinimo' => '0000',
            'valorEstandar' => '000.00',
            'valorMaximo' => '000.00',
        ]);
    }
}

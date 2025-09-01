<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AverageValueController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $value = [
            'valorMinimo' => '0000',
            'valorEstandar' => '000.00',
            'valorMaximo' => '000.00',
        ];

        return response()->json($value);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Service\ValuteService;
use Illuminate\Http\Request;

class CurrencyApiController extends Controller
{
    public function find(ValuteService $service, Request $request)
    {
        return response()->json($service->find($request->valuteID, $request->date_from, $request->date_to));
    }
}

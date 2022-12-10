<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $date = $request->date;
        if ($request->date === null) {
            $request->date = Carbon::now()->format('d-m-Y');
        }
        $quotes = Currency::where('date', '=', Carbon::create($request->date)->format('d-m-Y'))->get();
        return view('home', compact('quotes','date'));
    }
}

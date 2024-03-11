<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trade; 
use App\Models\Cryptocurrency; 
use Illuminate\Support\Facades\Auth;


class TradeController extends Controller
{
    public function create()
    {

        $cryptocurrencies = Cryptocurrency::all();
        return view('trades.create', compact('cryptocurrencies'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'cryptocurrency_id'=> 'required|exists:cryptocurrencies,id',
            'amount'=>'required|numeric',
            'trade_type'=>'required|in:buy,sell',
        ]);
        $trade = new Trade();
        $trade->user_id = Auth::id();
        $trade->cryptocurrency_id = $request->cryptocurrency_id;
        $trade->amount = $request->amount;
        $trade->trade_type = $request -> trade_type;

        $crypto = Cryptocurrency::find($request->cryptocurrency_id);
        $trade->price_at_trade = $crypto->price;

        $trade -> save();

        return redirect()->route('trades.index');
    }
    public function index()
    {
        $trades = Trade::where('user_id', Auth::id())->get();
        return view('trades.index', compact('trades'));
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cryptocurrency;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Investment;
class InvestmentController extends Controller
{

    public function index()
    {
        $investments = Auth::user()->investments()->with('cryptocurrency')->get();
        return view ('investments.index', compact('investments'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'cryptocurrency_id' => 'required|exists:cryptocurrencies,id', 
            'invested_amount' => 'required|numeric|max:1000000',
        ]);

        $crypto = Cryptocurrency::findorFail($request->cryptocurrency_id);
        $cryptoAmount = $request -> invested_amount / $crypto->price;

        Investment::create([
            'user_id'=> auth()->id(),
            'cryptocurrency_id'=> $crypto->id,
            'invested_amount'=>$request->invested_amount,
            'crypto_amount'=>$cryptoAmount,
            'price_at_investment'=> $crypto->price,
        ]);
        return redirect()->route('investments.index')->with('success', 'Investment made successfully.');
    }
}

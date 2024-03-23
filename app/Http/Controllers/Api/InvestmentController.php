<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with('cryptocurrency')->get();

        return response() -> json([
            'investments' => $investments,
            'totalPortfolioValue' => $investments->reduce(function ($carry,$investment){
                return $carry + ($investment ->cryptocurrency->price * $investment->crypto_amount);
            }, 0)
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $totalIncome = $user->transactions()
            ->whereHas('category', fn ($q) => $q->where('type', 'income'))
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $totalExpense = $user->transactions()
            ->whereHas('category', fn ($q) => $q->where('type', 'expense'))
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $balance = $totalIncome - $totalExpense;

        $transactions = $user->transactions()
            ->with('category')
            ->latest('date')
            ->take(10)
            ->get();

        return view('home', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'transactions'));
    }
}

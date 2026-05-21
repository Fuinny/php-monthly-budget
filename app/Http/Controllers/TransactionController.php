<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions = Auth::user()->transactions()->with('category')->latest()->get();
        $categories = Auth::user()->categories()->get();

        return view('transactions.index', compact('transactions', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        Auth::user()->transactions()->create($request->all());

        return redirect()->back()->with('success', 'Transakcija išsaugota!');
    }
}

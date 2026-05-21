<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $month = now()->month;
        $year = now()->year;

        $budgets = $user->budgets()
            ->where('budget_date', "$year-$month-01") // Budget is monthly, so we don't care about the day.
            ->get();

        $categories = $user->categories()->where('type', 'expense')->get();

        return view('budgets.index', compact('budgets', 'categories', 'month', 'year'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'category_id' => 'required|exists:categories,id',
            'amount_limit' => 'required|numeric|min:0',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer'
        ]);

        Auth::user()->budgets()->updateOrCreate(
          [
              'category_id' => $request->category_id,
              'budget_date' => $request->year . '-' . $request->month . '-01' // Budget is monthly, so we don't care about the day.
          ],
          [
              'amount_limit' => $request->amount_limit,
          ]
        );

        return redirect()->back()->with('success', 'Biudžeto limitas atnaujintas');
    }
}

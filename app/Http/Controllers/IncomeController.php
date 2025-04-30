<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Ensure you're using the correct model
use App\Models\Income;


class IncomeController extends Controller
{
    // Show all income records
    public function index()
    {
        $incomes = Transaction::where('type', 'income')->get();
        return view('income.index', compact('incomes'));
    }

    // Show the income form
    public function create()
    {
        return view('income.create'); // Ensure 'resources/views/income/create.blade.php' exists
    }

    // Store a new income record
    public function store(Request $request)
{
    // Validate input data
    $request->validate([
        'income_source' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'date_received' => 'required|date',
        'income_category' => 'required|string|max:255',
        'payment_method' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ]);

    // Store in transactions table
    Transaction::create([
        'title' => 'Income: ' . $request->income_source,
        'date' => $request->date_received,
        'category' => $request->income_source, 
        'amount' => $request->amount,
        'type' => 'income',
        'payment_method' => $request->payment_method ?? 'Cash', 
    ]);

    // Store in incomes table (with debug)
    $income = Income::create([
        'title' => 'Income: ' . $request->income_source,
        'amount' => $request->amount,
        'date' => $request->date_received,
        'category' => $request->income_category,
        'payment_method' => $request->payment_method,
        'description' => $request->description,
        'attachment' => null,
    ]);

    // Debugging
    if ($income) {
        return back()->with('success', 'Income added successfully and stored in database!');
    } else {
        return back()->with('error', 'Failed to save income in database!');
    }
}
}

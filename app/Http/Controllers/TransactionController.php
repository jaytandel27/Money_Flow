<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Fetch all transactions from DB (sorted by most recent)
        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        // Return the 'transactions.index' view with the data
        return view('transactions.index', compact('transactions'));
    }

    public function storeIncome(Request $request)
    {
        // Validate income data
        $request->validate([
            'income_source' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date_received' => 'required|date',
            // If you want a separate 'income_category', handle that too
        ]);

        // Create a new income transaction record
        Transaction::create([
            'date' => $request->date_received,
            'category' => $request->income_source, 
            'amount' => $request->amount,
            'type' => 'income',
            'payment_method' => $request->payment_method ?? 'Cash', 
        ]);

        return redirect()->route('transactions.index')->with('success', 'Income added successfully!');
    }

    public function storeExpense(Request $request)
    {
        // Validate expense data
        $request->validate([
            'expense_title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date_of_expense' => 'required|date',
            // If you want a separate 'expense_category', handle that too
        ]);

        // Create a new expense transaction record
        Transaction::create([
            'date' => $request->date_of_expense,
            'category' => $request->expense_title,
            'amount' => $request->amount,
            'type' => 'expense',
            'payment_method' => $request->payment_method ?? 'Cash',
        ]);

        return redirect()->route('transactions.index')->with('success', 'Expense added successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Expense;

class ExpenseController extends Controller
{
    // Show all expense records
    public function index()
    {
        $expenses = Transaction::where('type', 'expense')->get();
        return view('expenses.index', compact('expenses'));
    }

    // Show the expense form
    public function create()
    {
        return view('expenses.create'); // Ensure 'resources/views/expenses/create.blade.php' exists
    }

    // Store a new expense record
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'expense_title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date_of_expense' => 'required|date',
            'expense_category' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Store expense data in the transactions table
        Transaction::create([
            'title' => $request->expense_title, // ✅ Changed 'expense_title' to 'title'
            'amount' => $request->amount,
            'date' => $request->date_of_expense,
            'category' => $request->expense_category,
            'payment_method' => $request->payment_method,
            'type' => 'expense',
            'description' => $request->description,
        ]);


        
    // Store in the expenses table
    Expense::create([
        'expense_title' => $request->expense_title,
        'amount' => $request->amount,
        'date_of_expense' => $request->date_of_expense,
        'expense_category' => $request->expense_category,
        'payment_method' => $request->payment_method,
        'description' => $request->description,
    ]);


        

        // Redirect back to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Expense added successfully!');
    }
}

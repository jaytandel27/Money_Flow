<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // ✅ Use Transaction model instead
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Get summarized financial data.
     */
    private function getExpenseSummary()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $last7Days = Carbon::today()->subDays(6);
        $last30Days = Carbon::today()->subDays(29);

        return [
            'todaysExpense' => Transaction::where('type', 'expense')->whereDate('date', $today)->sum('amount'),
            'yesterdaysExpense' => Transaction::where('type', 'expense')->whereDate('date', $yesterday)->sum('amount'),
            'last7DaysExpense' => Transaction::where('type', 'expense')->whereBetween('date', [$last7Days, $today])->sum('amount'),
            'last30DaysExpense' => Transaction::where('type', 'expense')->whereBetween('date', [$last30Days, $today])->sum('amount'),
        ];
    }

    /**
     * Load dashboard view with financial data.
     */
    public function dashboard()
    {
        $expenseSummary = $this->getExpenseSummary();

        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('dashboard', array_merge([
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
        ], $expenseSummary));
    }

    /**
     * Fetch financial data for AJAX dashboard update.
     */
    public function getDashboardData()
    {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $expenseSummary = $this->getExpenseSummary();

        return response()->json(array_merge([
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
        ], $expenseSummary));
    }
}

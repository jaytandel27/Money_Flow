<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
//use App\Http\Controllers\API\Auth\RegisterController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyExpenseReminderMail;



// Home Page
Route::get('/', function () {
    return view('welcome');
});

// Custom Combined Auth Page (Sign In / Sign Up Animated Form)
Route::middleware('guest')->group(function () {
    Route::get('/auth', function () {
        return view('auth.auth');
    })->name('auth.custom');

    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

// Logout Route
Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout.perform');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getDashboardData'])->name('dashboard.data');

    // Income
    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::post('/income/store', [IncomeController::class, 'store'])->name('income.store');

    // Expense
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Expense Report
    Route::get('/expenses/report', [ExpenseController::class, 'report'])->name('expenses.report');

    // Password
    Route::get('/user/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('user.changePassword');
    Route::post('/user/change-password', [ProfileController::class, 'updatePassword'])->name('user.password.update');
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');

    // Profile
    Route::match(['POST', 'PUT'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/test-mail', function () {
        $user = \App\Models\User::first();
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\DailyExpenseReminderMail($user));
        return 'Test mail sent!';
    });
    
    

});
    
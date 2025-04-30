<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_title',  
        'amount',  
        'date_of_expense',  
        'expense_category',  
        'payment_method',  
        'description',  
        'attachment',  
    ];
}

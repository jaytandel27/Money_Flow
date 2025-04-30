<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title');                    // Replaces 'expense_title'
            $table->decimal('amount', 10, 2);
            $table->date('date');                       // Replaces 'date_of_expense'
            $table->string('category');                 // Replaces 'expense_category'
            $table->string('payment_method');
            $table->text('description')->nullable();
            $table->string('attachment')->nullable();   // Optional file field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};

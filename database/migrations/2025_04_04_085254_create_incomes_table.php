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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('title');                   // Replaces 'income_source'
            $table->decimal('amount', 10, 2);
            $table->date('date');                      // Replaces 'date_received'
            $table->string('category');                // Replaces 'income_category'
            $table->string('payment_method');
            $table->text('description')->nullable();
            $table->string('attachment')->nullable();  // Optional file upload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};

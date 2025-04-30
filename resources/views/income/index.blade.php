@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Income Form</h2>

        <form action="{{ route('income.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <input type="text" name="income_source" placeholder="Income Source" required class="border p-2 w-full mb-2">
            <input type="number" name="amount" placeholder="Amount" required class="border p-2 w-full mb-2">
            <input type="date" name="date_received" required class="border p-2 w-full mb-2">
            <input type="text" name="income_category" placeholder="Category" required class="border p-2 w-full mb-2">
            <input type="text" name="payment_method" placeholder="Payment Method" required class="border p-2 w-full mb-2">
            <textarea name="description" placeholder="Description" class="border p-2 w-full mb-2"></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add Income</button>
        </form>
    </div>
@endsection

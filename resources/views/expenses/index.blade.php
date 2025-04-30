@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Expenses</h2>
        
        <a href="{{ route('expenses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add New Expense</a>
        
        <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop through expenses if available --}}
                @foreach ($expenses as $expense)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $expense->description }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ number_format($expense->amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $expense->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

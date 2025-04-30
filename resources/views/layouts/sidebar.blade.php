<nav class="flex flex-col space-y-2 px-4 bg-gray-300 text-black h-full p-4">
    <a href="{{ route('dashboard') }}" class="bg-gray-500 text-black p-2 rounded transition duration-300 hover:bg-white hover:text-gray-800">
        Dashboard
    </a>
    <a href="{{ route('expenses.index') }}" class="bg-gray-500 text-black p-2 rounded transition duration-300 hover:bg-white hover:text-gray-800">
        Expenses
    </a>
    <a href="{{ route('expenses.report') }}" class="bg-gray-500 text-black p-2 rounded transition duration-300 hover:bg-white hover:text-gray-800">
        Expense Report
    </a>
    <a href="{{ route('user.index') }}" class="bg-gray-500 text-black p-2 rounded transition duration-300 hover:bg-white hover:text-gray-800">
        User
    </a>    

    <a href="{{ route('transactions.index') }}" class="flex items-center space-x-2 bg-gray-600 text-black font-semibold p-3 rounded-lg shadow-md transition duration-300 hover:bg-white hover:text-gray-800">
        📑 <span>Transactions</span>
    </a>

    <form method="POST" action="{{ route('logout.perform') }}" class="mt-4">
        @csrf
        <button class="w-full text-left p-2 bg-gray-700 text-black rounded transition duration-300 hover:bg-white hover:text-gray-800">
            Logout
        </button>
    </form>
</nav>

@php
    $transactions = App\Models\Transaction::latest()->take(5)->get();
@endphp

<!-- Recent Transactions Table -->
<div id="transaction-section" class="bg-white text-black rounded-lg shadow-md p-4 mt-4">
    <h2 class="text-lg font-bold mb-2">Recent Transactions</h2>

    @if ($transactions->isNotEmpty())
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-400">
                    <th class="border p-2 text-left">Title</th>
                    <th class="border p-2 text-right">Amount</th>
                    <th class="border p-2 text-left">Category</th>
                    <th class="border p-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody id="transactionTableBody">
                @foreach ($transactions as $transaction)
                    <tr class="border">
                        <td class="p-2">{{ $transaction->title }}</td>
                        <td class="p-2 text-right {{ $transaction->type == 'income' ? 'text-green-500' : 'text-red-500' }}">
                            ₹{{ number_format($transaction->amount, 2) }}
                        </td>
                        <td class="p-2">{{ $transaction->category }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-sm text-gray-500">No recent transactions.</p>
    @endif

    <a href="{{ route('transactions.index') }}" class="block mt-2 text-blue-500 text-sm hover:underline">View All Transactions</a>
</div>

<!-- User Profile Section -->
<div class="p-4 flex flex-col items-center bg-gray-300 text-black rounded-lg shadow-md">
    @if(Auth::user()->profile_picture)
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-20 h-20 rounded-full mb-4 border-4 border-gray-400">
    @else
        <div class="w-20 h-20 bg-white text-gray-700 font-bold text-3xl flex items-center justify-center rounded-full mb-4 shadow-lg">
            {{ strtoupper(Auth::user()->name[0]) }}
        </div>
    @endif
    <h2 class="font-semibold text-xl">{{ Auth::user()->name }}</h2>
    <span class="text-sm text-green-600 mb-4">● Online</span>
</div>

<!-- Small User Info Section -->
<div class="flex items-center space-x-3">
    @if(Auth::user()->profile_picture)
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-10 h-10 rounded-full border-2 border-gray-400">
    @else
        <div class="w-10 h-10 bg-white text-gray-700 font-bold text-xl flex items-center justify-center rounded-full shadow-lg">
            {{ strtoupper(Auth::user()->name[0]) }}
        </div>
    @endif
    <span class="font-semibold">{{ Auth::user()->name }}</span>
</div>

<div class="sidebar-profile text-center bg-gray-300 p-4 rounded-lg shadow-md">
    @if(auth()->user()->profile_picture)
        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
             alt="User Profile" 
             class="profile-img w-12 h-12 rounded-full border border-gray-400 shadow-md">
    @else
        <div class="w-12 h-12 bg-white text-gray-700 font-bold text-xl flex items-center justify-center rounded-full shadow-lg">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
    @endif
    <p class="username">{{ auth()->user()->name }}</p>
</div>

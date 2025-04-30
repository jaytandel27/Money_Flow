    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <title>Dashboard</title> -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('css/light-theme.css') }}">

        <script>
            function showSection(section) {
                // Hide all sections
                document.getElementById('dashboard-section').classList.add('hidden');
                document.getElementById('add-income-form').classList.add('hidden');
                document.getElementById('add-expense-form').classList.add('hidden');
                document.getElementById('transaction-section').classList.add('hidden');
                document.getElementById('change-password-form').classList.add('hidden');
                document.getElementById('user-profile-section').classList.add('hidden'); // Add this line


                // Show the selected section
                document.getElementById(section).classList.remove('hidden');
            }

            function toggleDropdown() {
                document.getElementById('financial-dropdown').classList.toggle('hidden');
            }
        </script>

            
    </head>


<body>
        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-72 min-h-screen p-6 bg-white shadow-xl text-blue-600">
            <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-white text-green-500 font-bold text-3xl flex items-center justify-center rounded-full mb-4 shadow-lg overflow-hidden">

          @if(Auth::user()->profile_picture)
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover">
    @else
        {{ Auth::user()->name[0] }}
    @endif
        </div>
        <h2 class="font-semibold text-xl text-black">{{ Auth::user()->name }}</h2>
        </br>
                    <!-- <span class="text-sm text-black mb-4">● Online</span> -->
                    <!-- <div class="w-full h-2 bg-gradient-to-r from-black via-gray-800 to-black my-4 rounded-full"></div> -->

                </div>

                <link rel="stylesheet" href="{{ asset('css/light-theme.css') }}">


                <nav class="flex flex-col space-y-3">
                <button onclick="showSection('dashboard-section')" 
                 class="flex items-center space-x-2 bg-gradient-to-br from-blue-200 to-white text-black font-semibold p-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">

    🏠 <span>Dashboard</span>
</button>

<!-- Financial Records Button (Toggle Submenu) -->
<!-- Financial Records (With Dropdown Items Below) -->
<div class="relative">
    <!-- Toggle Button -->
    <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gradient-to-br from-blue-200 to-white text-black font-semibold p-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
        <span class="flex items-center space-x-2">
            📊 <span>Financial Records</span>
        </span>
        <span id="dropdown-arrow">▼</span>
    </button>

    <!-- Dropdown Items (Initially Hidden) -->
   <!-- Dropdown Items (Initially Hidden, Light Gradient Blue) -->
   <!-- Dropdown Items (No Background) -->
<!-- Dropdown Items (Blue background like sidebar) -->
<div id="financial-dropdown" class="hidden flex flex-col mt-2 space-y-2 bg-white p-2 rounded-lg shadow">
    <button onclick="showSection('add-income-form')" class="flex items-center space-x-2 bg-gradient-to-br from-blue-200 to-white text-black font-semibold p-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
    
        ➕ <span>Add Income</span>
    </button>
    <button onclick="showSection('add-expense-form')" class="flex items-center space-x-2 bg-gradient-to-br from-blue-200 to-white text-black font-semibold p-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
        ➖ <span>Add Expenses</span>
    </button>
</div>




</div>




<button onclick="showSection('transaction-section')" class="flex items-center space-x-2 bg-gradient-to-br from-blue-200 to-white text-black font-semibold p-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">

    📑 <span>View Transactions</span>
</button>

                    

                    
        <!-- User Profile Button -->
        <button onclick="showSection('user-profile-section')"  class="flex items-center space-x-2 bg-gradient-to-br from-blue-200 to-white text-black font-semibold p-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">

    👤 <span>User Profile</span>
</button>


                     <!-- Change Password Button -->
                     <button onclick="showSection('change-password-form')"  class="flex items-center space-x-2 bg-gradient-to-br from-blue-200 to-white text-black font-semibold p-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">

    🔑 <span>Change Password</span>
</button>


                    <form method="POST" action="{{ route('logout.perform') }}" class="mt-4">
                        @csrf
                        <button class="w-full flex items-center space-x-2 p-3 bg-gradient-to-br from-blue-200 to-white text-black rounded-lg shadow-md hover:bg-red-100 hover:text-red-700 transition duration-300">
                        🚪 <span>Logout</span>
</button>

                    </form>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6 bg-black text-Black">
            <h1 class="text-3xl font-bold text-black mb-4">Dashboard</h1>

 <!-- Dashboard Section -->
<div id="dashboard-section">
    <!-- Balance Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 p-4 rounded-lg bg-gray-800 shadow-lg mb-6">
    <div class="bg-gradient-to-br from-green-200 to-white p-3 rounded-lg text-center text-black shadow-lg hover:shadow-xl transition-shadow duration-300">
    <h3>Total Income</h3>
            <div class="text-2xl font-bold" id="total-income">₹ 0</div>
        </div>
        <div class="bg-gradient-to-br from-red-200 to-white p-3 rounded-lg text-center text-black shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h3>Total Expense</h3>
            <div class="text-2xl font-bold" id="total-expense">₹ 0</div>
        </div>
        <div class="bg-gradient-to-br from-purple-200 to-white p-3 rounded-lg text-center text-black shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h3>Balance</h3>
            <div class="text-2xl font-bold" id="balance">₹ 0</div>
        </div>
    </div>

    <!-- Expense Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4 rounded-lg bg-gray-800 shadow-lg">
    <div class="bg-gradient-to-br from-purple-200 to-white p-3 rounded-lg text-center text-black shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h3>Today's Expense</h3>
            <div class="text-2xl font-bold" id="todays-expense">₹ 0</div>
        </div>
    <div class="bg-gradient-to-br from-yellow-200 to-white p-3 rounded-lg text-center text-black shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h3>Yesterday's Expense</h3>
            <div class="text-2xl font-bold" id="yesterdays-expense">₹ 0</div>
        </div>
        <div class="bg-gradient-to-br from-green-200 to-white p-3 rounded-lg text-center text-black shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h3>Last 7 Days Expense</h3>
            <div class="text-2xl font-bold" id="last7days-expense">₹ 0</div>
        </div>
        <div class="bg-gradient-to-br from-red-200 to-white p-3 rounded-lg text-center text-black shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h3>Last 30 Days Expense</h3>
            <div class="text-2xl font-bold" id="last30days-expense">₹ 0</div>
        </div>
    </div>
</div>

<!-- JavaScript should go here -->
<script>
    function formatCurrency(amount) {
        return new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(amount || 0);
    }

    function updateDashboard(data) {
        document.getElementById('total-income').innerText = formatCurrency(data.totalIncome);
        document.getElementById('total-expense').innerText = formatCurrency(data.totalExpense);
        document.getElementById('balance').innerText = formatCurrency(data.balance);
        document.getElementById('todays-expense').innerText = formatCurrency(data.todaysExpense);
        document.getElementById('yesterdays-expense').innerText = formatCurrency(data.yesterdaysExpense);
        document.getElementById('last7days-expense').innerText = formatCurrency(data.last7DaysExpense);
        document.getElementById('last30days-expense').innerText = formatCurrency(data.last30DaysExpense);
    }

    function fetchDashboardData() {
    document.querySelectorAll('.text-2xl.font-bold').forEach(el => el.innerText = 'Loading...');

    fetch('/dashboard/data')
        .then(response => response.json())
        .then(data => {
            console.log("Dashboard Data:", data); // Debugging log
            updateDashboard(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.querySelectorAll('.text-2xl.font-bold').forEach(el => el.innerText = 'Error!');
        });
}

    document.addEventListener("DOMContentLoaded", fetchDashboardData);
</script>


                <!-- Income Form -->
                <div id="add-income-form" class="hidden">
    <div class="max-w-4xl mx-auto bg-white text-gray-800 rounded-xl p-6">
        <form action="{{ route('income.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg text-white max-w-4xl mx-auto">
            @csrf
            <h2 class="text-xl font-semibold mb-6 text-center"> Add Income</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div>
                    <label class="block mb-1">Income Source:</label>
                    <input type="text" name="income_source" class="w-full p-2 border rounded bg-gray-700 text-white mb-4" placeholder="Enter source">

                    <label class="block mb-1">Amount:</label>
                    <input type="number" name="amount" class="w-full p-2 border rounded bg-gray-700 text-white mb-4" placeholder="Enter amount">

                    <label class="block mb-1">Date Received:</label>
                    <input type="date" name="date_received" class="w-full p-2 border rounded bg-gray-700 text-white mb-4">
                </div>

                <!-- Right Column -->
                <div>
                    <label class="block mb-1">Income Category:</label>
                    <select name="income_category" class="w-full p-2 border rounded bg-gray-700 text-white mb-4">
                        <option value="Job">Job</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Business">Business</option>
                    </select>

                    <label class="block mb-1">Payment Method:</label>
                    <select name="payment_method" class="w-full p-2 border rounded bg-gray-700 text-white mb-4">
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>

                    <label class="block mb-1">Notes (Optional):</label>
                    <textarea name="description" class="w-full p-2 border rounded bg-gray-700 text-white" placeholder="Additional details"></textarea>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-green-600 hover:bg-green-700 transition px-6 py-2 rounded text-white font-semibold">
                    💾 Save Income
                </button>
            </div>
        </form>
    </div>
</div>



    <!-- Expense Form -->
    <div id="add-expense-form" class="hidden">
        <form action="{{ route('expense.store') }}" method="POST" class="bg-gray-800 p-4 rounded-lg shadow-lg">
            @csrf
            <h2 class="text-lg font-semibold mb-4">Add Expense</h2>

            <label class="block">Expense Title:</label>
            <input type="text" name="expense_title" class="w-full p-0.5 mb-1 border rounded bg-gray-700 text-white" placeholder="Enter title">

            <label class="block">Amount:</label>
            <input type="number" name="amount" class="w-full p-0.5 mb-1 border rounded bg-gray-700 text-white" placeholder="Enter amount">

            <label class="block">Date of Expense:</label>
            <input type="date" name="date_of_expense" class="w-full p-0.5 mb-1 border rounded bg-gray-700 text-white">

            <label class="block">Expense Category:</label>
            <select name="expense_category" class="w-full p-0.5 mb-1 border rounded bg-gray-700 text-white">
                <option value="Food">Food</option>
                <option value="Rent">Rent</option>
                <option value="Transport">Transport</option>
                <option value="Utilities">Utilities</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Other">Other</option>
            </select>

                <label class="block">Payment Method:</label>
                <select name="payment_method" class="w-full p-0.5 mb-1 border rounded bg-gray-700 text-white">
                    <option val ue="Cash">Cash</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="UPI">UPI</option>
                </select>
                <label class="block">Upload Bill:</label>
    <input type="file" name="bill" class="w-full p-0.5 mb-1 border rounded bg-gray-700 text-white">

            <label class="block">Notes (Optional):</label>
            <textarea name="description" class="w-full p-0.5 mb-1 border rounded bg-gray-700 text-white" placeholder="Additional details"></textarea>

            <button type="submit" class="bg-red-500 p-0.5 rounded w-full text-white">Save Expense</button>
        </form>
    </div>


<!-- Change Password Form (initially hidden) -->
<div id="change-password-form" class="hidden bg-gray-800 text-black p-6 rounded-lg shadow-lg mt-4">
    <h2 class="text-lg font-semibold mb-4">Change Password</h2>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <label class="block">Current Password:</label>
        <input type="password" name="current_password" class="w-full p-2 mb-2 border rounded bg-white text-black" required>
        
        <label class="block">New Password:</label>
        <input type="password" name="new_password" class="w-full p-2 mb-2 border rounded bg-white text-black" required>
        
        <label class="block">Confirm New Password:</label>
        <input type="password" name="confirm_password" class="w-full p-2 mb-2 border rounded bg-white text-black" required>
        
        <button type="submit" class="bg-blue-500 p-2 rounded w-full text-white">Update Password</button>
    </form>
</div>


                <!-- Transactions Section -->
                <div id="transaction-section" class="hidden bg-white text-black rounded-lg shadow-md p-4 mt-4">
                    <h2 class="text-lg font-bold mb-2">Recent Transactions</h2>

                    @php
                        $transactions = App\Models\Transaction::latest()->take(5)->get();
                    @endphp

                    @if ($transactions->isNotEmpty())
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border p-2">Title</th>
                                    <th class="border p-2">Amount</th>
                                    <th class="border p-2">Category</th>
                                    <th class="border p-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr class="border">
                                        <td class="p-2">{{ $transaction->title }}</td>
                                        <td class="p-2">{{ $transaction->amount }}</td>
                                        <td class="p-2">{{ $transaction->category }}</td>
                                        <td class="p-2">{{ $transaction->date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No recent transactions.</p>
                    @endif
                </div>

   <!-- User Profile Section -->
<div id="user-profile-section" class="hidden bg-gray-800 text-white p-6 rounded-lg shadow-lg">
    <h2 class="text-lg font-semibold mb-4">Profile Information</h2>

    <!-- Profile Picture Preview -->
    <div class="flex items-center mb-4">
        <div class="w-20 h-20 bg-white text-red-700 font-bold text-3xl flex items-center justify-center rounded-full shadow-lg overflow-hidden">
            @if(Auth::user()->profile_picture)
                <img id="profilePreview" src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover">
            @else
                {{ Auth::user()->name[0] }}
            @endif
        </div>
    </div>

    <!-- Profile Update Form -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUt')

        <label class="block">Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="w-full p-2 mb-2 border rounded bg-gray-700 text-white" onchange="previewImage(event)">

        <label class="block">Name:</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full p-2 mb-2 border rounded bg-gray-700 text-white" required>

        <label class="block">Email:</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full p-2 mb-2 border rounded bg-gray-700 text-white" required>

        <button type="submit" class="bg-blue-500 p-2 rounded w-full text-white">Save</button>
    </form>
</div>

<!-- JavaScript to Show Profile Preview -->
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('profilePreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>


</main>
            </main>
        </div>

        
    </body>
    </html>

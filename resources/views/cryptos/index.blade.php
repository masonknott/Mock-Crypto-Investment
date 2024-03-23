<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Crypto - Crypto Investor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Crypto Investor</a>
            <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">

            <a href="/cryptos" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-coins mr-3"></i>
                Buy Crypto
            </a>
            <a href="/investments" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-wallet mr-3"></i>
                Portfolio
            </a>
        </nav>
    </aside>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <!-- User Profile & Dropdown -->
            </div>
        </header>

        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Buy Cryptocurrencies</h1>
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <form action="/investments" method="POST" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="cryptocurrency" class="block text-gray-700 text-sm font-bold mb-2">Select Cryptocurrency:</label>
                        <select name="cryptocurrency_id" id="cryptocurrency" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @foreach ($cryptos as $crypto)
                                <option value="{{ $crypto->id }}">{{ $crypto->name }} ({{ $crypto->symbol }}) - ${{ number_format($crypto->price, 2) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="invested_amount" class="block text-gray-700 text-sm font-bold mb-2">Amount to Invest ($):</label>
                        <input type="number" name="invested_amount" id="invested_amount" step="0.01" min="0.01" max="100000" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Invest</button>
                    </div>
                </form>
            </div>
        </main>

        <footer class="w-full bg-white text-right p-4">
            Built by <a href="https://github.com/masonknott" target="_blank" class="underline">Mason Knott</a>.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/js/all.js"></script>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 Cryptocurrencies</title>
</head>
<body>
        <div style="margin-bottom: 20px;">
        <a href="/investments" style="padding: 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">View Investments</a>
    </div>

    <h1>Top 10 Cryptocurrencies</h1>
    
    <!-- Investment Form -->
    <h2>Make an Investment</h2>
    <form action="/investments" method="POST">
        @csrf <!-- CSRF Token for form submission -->
        
        <label for="cryptocurrency">Select Cryptocurrency:</label>
        <select name="cryptocurrency_id" id="cryptocurrency" required>
            @foreach ($cryptos as $crypto)
                <option value="{{ $crypto->id }}">{{ $crypto->name }} ({{ $crypto->symbol }})</option>
            @endforeach
        </select>

        <label for="invested_amount">Amount to Invest:</label>
        <input type="number" name="invested_amount" id="invested_amount" step="0.01" min="0.01" max="1000000" required>
        
        <button type="submit">Invest</button>
    </form>

    @if(!$cryptos->isEmpty())
        <ul>
            @foreach ($cryptos as $crypto)
                <li>{{ $crypto->name }} ({{ $crypto->symbol }}): ${{ number_format($crypto->price, 2) }}</li>
            @endforeach
        </ul>
    @else
        <p>No cryptocurrency data available.</p>
    @endif
</body>
</html>

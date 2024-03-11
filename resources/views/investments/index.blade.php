<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Investments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .text-success {
            color: green;
        }
        .text-danger {
            color: red;
        }
    </style>
</head>
<body>
<div style="margin-bottom: 20px;">
        <a href="/cryptos" style="padding: 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">View Cryptocurrencies</a>
    </div>

    <h1>Your Investments</h1>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if($investments->isEmpty())
        <p>You have not made any investments yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Cryptocurrency</th>
                    <th>Amount Invested</th>
                    <th>Price at Investment</th>
                    <th>Current Price</th>
                    <th>Profit/Loss</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($investments as $investment)
                <tr>
                    <td>{{ $investment->cryptocurrency->name }} ({{ $investment->cryptocurrency->symbol }})</td>
                    <td>${{ number_format($investment->invested_amount, 2) }}</td>
                    <td>${{ number_format($investment->price_at_investment, 2) }}</td>
                    <td>${{ number_format($investment->cryptocurrency->price, 2) }}</td>
                    <td>
                        @php
                            $profitLoss = ($investment->cryptocurrency->price - $investment->price_at_investment) * $investment->crypto_amount;
                        @endphp
                        <span class="{{ $profitLoss > 0 ? 'text-success' : 'text-danger' }}">
                            ${{ number_format($profitLoss, 2) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>

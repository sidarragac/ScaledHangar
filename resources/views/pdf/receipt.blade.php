<!DOCTYPE html>
<html>
<head>
    <title>Cart Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .receipt {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .receipt-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .receipt-body table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .receipt-body th, 
        .receipt-body td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .receipt-footer {
            text-align: right;
            font-weight: bold;
        }
        .company-info {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <h1>Cart Receipt</h1>
        </div>

        <div class="company-info">
            <h2>{{ $company['name'] }}</h2>
            <p>{{ $company['address'] }}</p>
            <p>{{ $company['phone'] }} | {{ $company['email'] }}</p>
        </div>

        <div class="receipt-body">
            <p><strong>Order Number:</strong> {{ $order_number }}</p>
            <p><strong>Date:</strong> {{ $date }}</p>

            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->getName() }}</td>
                        <td>${{ number_format($product->getPrice(), 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="receipt-footer">
            <p>Total: ${{ $total }}</p>
        </div>
    </div>
</body>
</html>
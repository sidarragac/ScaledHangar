<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: 'DejaVu Sans', serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .receipt {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
        }
        .receipt-body th, .receipt-body td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .receipt-footer {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <h1>{{ $company['name'] }}</h1>
            <p>{{ $company['address'] }}</p>
            <p>{{ $company['phone'] }} | {{ $company['email'] }}</p>
        </div>

        <div class="receipt-body">
            <p><strong>Order Number:</strong> {{ $order_number }}</p>
            <p><strong>Date:</strong> {{ $date }}</p>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
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
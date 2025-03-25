<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 15px; }
        .company-info { margin-bottom: 20px; }
        .details { margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        .total { font-weight: bold; font-size: 1.1em; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 2px solid #000; text-align: center; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Payment Receipt</h1>
        <p>Order Number: {{ $order_number }}</p>
        <p>Date: {{ $date }}</p>
    </div>

    <div class="company-info">
        <h3>{{ $company['name'] }}</h3>
        <p>{{ $company['address'] }}</p>
        <p>Tel: {{ $company['phone'] }}</p>
        <p>Email: {{ $company['email'] }}</p>
    </div>

    <div class="details">
        <h3>Purchased Items:</h3>
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
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total">
                    <td>Total:</td>
                    <td>${{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer">
        <p>Thank you for your purchase!</p>
        <p>This is an official receipt - Please retain for your records</p>
    </div>
</body>
</html>
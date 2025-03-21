<!DOCTYPE html>
<html>
<head>
    <title>Factura #{{ $order->getId() }}</title>
</head>
<body>
    <h1>Factura #{{ $order->getId() }}</h1>
    <table>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->getName() }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ number_format($item->price, 2) }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
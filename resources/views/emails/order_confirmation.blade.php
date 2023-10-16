<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
<h1>Order Confirmation</h1>

<p>Dear {{ $order->user ? $order->user->name : 'Customer' }},</p>

<p>Your order has been confirmed with the following details:</p>

<ul>
    @foreach ($order->products as $product)
        <li>{{ $product->name }} (Quantity: {{ $product->pivot->quantity }})</li>
    @endforeach
</ul>

<p>Total Amount: {{ $order->total_amount }}</p>

<p>Thank you for shopping with us!</p>
</body>
</html>

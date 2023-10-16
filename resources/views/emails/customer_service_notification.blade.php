<!DOCTYPE html>
<html>
<head>
    <title>Customer Service Notification</title>
</head>
<body>
<h1>Customer Service Notification</h1>

<p>Dear Customer Service,</p>

<p>An order has been received with the following details:</p>

<ul>
    @foreach ($order->products as $product)
        <li>{{ $product->name }} (Quantity: {{ $product->pivot->quantity }})</li>
    @endforeach
</ul>

<p>Total Amount: {{ $order->total_amount }}</p>

<p>Please attend to this order as soon as possible.</p>
</body>
</html>

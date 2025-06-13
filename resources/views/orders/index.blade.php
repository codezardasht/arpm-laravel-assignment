<h1>Orders</h1>
<table border="1" cellpadding="8">
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Total Amount</th>
        <th>Items Count</th>
        <th>Last Added to Cart</th>
        <th>Completed?</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($orders as $order)
        <tr>
            <td>{{ $order['order_id'] }}</td>
            <td>{{ $order['customer_name'] }}</td>
            <td>{{ $order['total_amount'] }}</td>
            <td>{{ $order['items_count'] }}</td>
            <td>{{ $order['last_added_to_cart'] }}</td>
            <td>{{ $order['completed_order_exists'] ? 'Yes' : 'No' }}</td>
            <td>{{ $order['created_at'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

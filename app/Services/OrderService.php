<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Public method to fetch and transform orders for presentation
     */
    public function getTransformedOrders(): Collection
    {
        $orders = $this->fetchOrdersWithRelations();
        $lastCartItems = $this->getLastCartItems($orders);

        $orderData = $this->transformOrders($orders, $lastCartItems);

        return $this->sortOrdersByCompletionDate($orderData);
    }

    /**
     * Fetch orders with related models using eager loading
     */
    private function fetchOrdersWithRelations(): Collection
    {
        return Order::with([
            'customer:id,name',
            'items:id,order_id,product_id,price,quantity',
            'items.product:id,name',
        ])
            ->select([
                'orders.id',
                'orders.customer_id',
                'orders.status',
                'orders.created_at',
                'orders.completed_at',
            ])
            ->get();
    }

    /**
     * Get last cart item timestamps for given orders
     */
    private function getLastCartItems(Collection $orders): Collection
    {
        return CartItem::select('order_id', DB::raw('MAX(created_at) as last_added'))
            ->whereIn('order_id', $orders->pluck('id'))
            ->groupBy('order_id')
            ->pluck('last_added', 'order_id');
    }

    /**
     * Transform orders into simplified structure
     */
    private function transformOrders(Collection $orders, Collection $lastCartItems): Collection
    {
        return $orders->map(function ($order) use ($lastCartItems) {
            $totalAmount = $order->items->sum(fn ($item) => $item->price * $item->quantity);

            return [
                'order_id' => $order->id,
                'customer_name' => $order->customer->name,
                'total_amount' => $totalAmount,
                'items_count' => $order->items->count(),
                'last_added_to_cart' => $lastCartItems[$order->id] ?? null,
                'completed_order_exists' => $order->status === 'completed',
                'created_at' => $order->created_at,
                'completed_at' => $order->completed_at,
            ];
        });
    }

    /**
     * Sort orders by their completion date
     */
    private function sortOrdersByCompletionDate(Collection $orderData): Collection
    {
        return $orderData->sortByDesc(function ($order) {
            return $order['completed_order_exists'] ? $order['completed_at'] : null;
        })->values();
    }

    /**
     * SUGGESTION TO IMPROVE:
     *
     * Add completed_at column to the orders table (if not present).
     *
     * Use pagination: Order::paginate(10)
     *
     * Move this logic into a Service class for cleaner controller LIKE ABOVE.
     */
}

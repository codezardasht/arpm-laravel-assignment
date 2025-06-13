<?php

namespace App\Http\Controllers;


use App\Services\OrderService;


class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function index()
    {
        $orders = $this->orderService->getTransformedOrders();
        return view('orders.index', ['orders' => $orders]);
    }
}


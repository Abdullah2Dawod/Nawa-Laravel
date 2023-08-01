<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrdersController extends Controller
{

    public function __construct()
    {
        $orders = Order::all();
        View::share([
            "orders" => $orders,
            'status_options' => Order::statusOptions(),
            'status_payment' => Order::paymentStatusOptions(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $orders = Order::filter($request)->paginate(10);
        return view('admin.orders.index', [
            'title' => 'Orders List',
            'orders' => $orders,
            'status_options' => Order::statusOptions(),
            'payment_status' => Order::paymentStatusOptions(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', [
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()
            ->route('orders.index')
            ->with('success', "Has Been Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
        ->route('orders.index')
        ->with('success', "order Has Been Deleted Successfully");
    }

    public function trashed()
    {
        $orders = Order::onlyTrashed()->paginate(10);
        return view('admin.orders.trashed', [
            'orders' => $orders
        ]);
    }

    public function restore(String $id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->restore();
        return redirect()
            ->route('orders.index')
            ->with('success', "order restored");
    }

    public function forceDelete(String $id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->forceDelete();

        return redirect()
            ->route('orders.trashed')
            ->with('success', "order Deleted Forever");
    }

}

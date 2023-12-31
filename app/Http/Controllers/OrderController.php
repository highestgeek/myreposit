<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all(); // Fetch all orders (replace "Order" with your actual model name)
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_zipcode' => 'required',
            'shipping_phone' => 'required'
        ]);

        $order = new Order();

        $order->order_number = uniqid('OrderNumber-');

        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_state = $request->input('shipping_state');
        $order->shipping_zipcode = $request->input('shipping_zipcode');
        $order->shipping_phone = $request->input('shipping_phone');

        if (!$request->has('billing_fullname')) {
            $order->billing_fullname = $request->input('shipping_fullname');
            $order->billing_address = $request->input('shipping_address');
            $order->billing_city = $request->input('shipping_city');
            $order->billing_state = $request->input('shipping_state');
            $order->billing_zipcode = $request->input('shipping_zipcode');
            $order->billing_phone = $request->input('shipping_phone');
        } else {
            $order->billing_fullname = $request->input('billing_fullname');
            $order->billing_address = $request->input('billing_address');
            $order->billing_city = $request->input('billing_city');
            $order->billing_state = $request->input('billing_state');
            $order->billing_zipcode = $request->input('billing_zipcode');
            $order->billing_phone = $request->input('billing_phone');
        }
        
        $order->grand_total = \Cart::session(auth()->id())->getTotal();
        $order->item_count = \Cart::session(auth()->id())->getContent()->count();
        
        $order->user_id = auth()->id();

        if (request('payment_method') == 'paypal') {
            $order->payment_method = 'paypal';
        }

        $order->save();

        $cartItems = \Cart::session(auth()->id())->getContent();

        foreach($cartItems as $item) {
            $order->items()->attach($item->id, ['price' => $item->price, 'quantity' => $item->quantity]);
        }

        if (request('payment_method') == 'paypal') {
            return redirect()->route('paypal.checkout', $order->id);
        }

        \Cart::session(auth()->id())->clear();

        return redirect()->route('cart.index')->with('msg', 'order placed sucessfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:completed,decline',
        ]);
    
        $order->status = $request->input('status');
        $order->save();
    
        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

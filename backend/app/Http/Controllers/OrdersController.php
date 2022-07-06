<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\EditOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Get all orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with('status')->with('customer')->with('product')
            ->search($request)->get();

        return response()->json($orders->toArray(), 200);
    }

    /**
     * Create a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateOrderRequest $request)
    {
        $data = $request->validated();

        $product = Product::find($data["product_id"]);

        if($data["quantity"] > $product->amount) return response()->json([
            "error" => "Há apenas ".$product->amount." unidades deste produto",
        ], 403);

        $data["status_id"] = 1;

        $data["value"] = $data["quantity"] * $product->price;

        $order = Order::create($data);

        return response()->json($order->toArray(), 200);
    }

    /**
     * Get the details of an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request, int $order_id)
    {
        $order = Order::with('customer')->with('product')->with('status')->find($order_id);

        if(!$order) return response()->json([
            "Error" => "Pedido não encontrado"
        ], 404);

        return response()->json($order->toArray(), 200);
    }


    /**
     * Edit an order.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditOrderRequest $request, int $order_id)
    {
        $data = $request->validated();

        $order = Order::find($order_id);

        if(!$order) return response()->json([
            "errors" => [
                "unfound" => [
                    "Order not found."
                ]
            ]
        ], 404);

        $product = Product::find($data["product_id"]);

        if($data["quantity"] > $order->quantity + $product->current_amount) return response()->json([
            "errors" => [
                "amount" => [
                    "There are only".$product->current_amount." units of this product."
                ]
            ],
        ], 403);

        $data["value"] = $data["quantity"] * $product->price;

        $order->update($data);

        return response()->json($order->toArray(), 200);
    }

    /**
     * Put the order as opend.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function putAsOpend(Request $request, int $order_id)
    {
        $order = Order::find($order_id);

        if(!$order) return response()->json([
            "Error" => "Pedido não encontrado"
        ], 404);

        $order->status_id = 1;

        $order->save();

        return response()->json([
            "success" => "Pedido definido como em espera!",
            "order_id" => $order->id
        ], 200);
    }

    /**
     * Put the order as paid.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function putAsPaid(Request $request, int $order_id)
    {
        $order = Order::find($order_id);

        if(!$order) return response()->json([
            "Error" => "Pedido não encontrado"
        ], 404);

        $order->status_id = 2;

        $order->save();

        return response()->json([
            "success" => "Pedido pago!",
            "order_id" => $order->id
        ], 200);
    }

    /**
     * Put the order as paid.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function putAsCanceled(Request $request, int $order_id)
    {
        $order = Order::find($order_id);

        if(!$order) return response()->json([
            "Error" => "Pedido não encontrado"
        ], 404);

        $order->status_id = 3;

        $order->save();

        return response()->json([
            "success" => "Pedido cancelado!",
            "order_id" => $order->id
        ], 200);
    }

    /**
     * Delete an order.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $order_id)
    {
        $order = Order::find($order_id);

        if(!$order) return response()->json([
            "Error" => "Pedido não encontrado"
        ], 404);

        $order->delete();

        return response()->json([
            "success" => "Pedido excluido com sucesso!",
            "order_id" => $order->id
        ], 200);
    }
}

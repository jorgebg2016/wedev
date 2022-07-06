<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Get all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query()->search($request)->get();

        $current_amount = null;

        if($request->only('currentamount')) $current_amount = $request
            ->only('currentamount')['currentamount'];

        if($current_amount) {

            $products = $products->filter(function($value, $key) use ($current_amount) {

                return $value['current_amount']==$current_amount;
            })->values();
        }
        

        return response()->json($products->toArray(), 200);
    }

    /**
     * Create a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create($data);

        return response()->json($product->toArray(), 200);
    }

    /**
     * Get the details of a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request, int $product_id)
    {
        $product = Product::with(['orders' => function($order) {

            $order->with('customer');

        }])->find($product_id);

        if(!$product) return response()->json([
            "error" => "Produto não encontrado"
        ], 404);

        return response()->json($product->toArray(), 200);
    }

    /**
     * Edit a product.
     *
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditProductRequest $request, int $product_id)
    {
        $data = $request->validated();

        $product = Product::find($product_id);

        if(!$product) return response()->json([
            "error" => "Produto não encontrado"
        ], 404);

        $product->update($data);

        return response()->json($product->toArray(), 200);
    }

    /**
     * Delete a product.
     *
     * @param  int  $product_id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $product_id)
    {
        $product = Product::find($product_id);

        if(!$product) return response()->json([
            "error" => "Produto não encontrado"
        ], 404);

        $product->delete();

        return response()->json([
            "success" => "Produto excluido com sucesso!",
            "product_id" => $product->id
        ], 200);
    }
}

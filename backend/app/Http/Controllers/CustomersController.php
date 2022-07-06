<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\EditCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Get all customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::query()->with('gender')->search($request)->get();

        return response()->json($customers->toArray(), 200);
    }

    /**
     * Create a new customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateCustomerRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::create($data);

        return response()->json($customer->toArray(), 200);
    }

    /**
     * Get the details of a customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail(int $customer_id)
    {
        $customer = Customer::with(['orders' => function($order) {

            $order->with('product');

        }])->with('gender')->find($customer_id);

        if(!$customer) return response()->json([
            "Error" => "Cliente não encontrado"
        ], 404);

        return response()->json($customer->toArray(), 200);
    }

    /**
     * Edit a customer.
     *
     * @param  int  $customer_id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditCustomerRequest $request, int $customer_id)
    {
        $data = $request->validated();

        $customer = Customer::find($customer_id);

        if(!$customer) return response()->json([
            "Error" => "Cliente não encontrado"
        ], 404);

        $customer->update($data);

        return response()->json($customer->toArray(), 200);
    }

    /**
     * Delete a customer.
     *
     * @param  int  $customer_id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $customer_id)
    {
        $customer = Customer::find($customer_id);

        if(!$customer) return response()->json([
            "Error" => "Cliente não encontrado"
        ], 404);

        $customer->delete();

        return response()->json([
            "success" => "Cliente excluido com sucesso!",
            "customer_id" => $customer->id
        ], 200);
    }
}

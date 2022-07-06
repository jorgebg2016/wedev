<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CustomersController,
    ProductsController,
    OrdersController
};


/**
 * Routes of customers.
 */
Route::prefix('/customers')->group(function(){

    Route::get('/{customer_id}/detail', [CustomersController::class, 'detail']);

    Route::get('/{name?}/{cpf?}/{gender?}/{birthday?}/{email?}/{phone?}', 
        [CustomersController::class, 'index']);

    Route::post('/create', [CustomersController::class, 'create']);

    Route::patch('/{customer_id}/edit', [CustomersController::class, 'edit']);

    Route::delete('/{customer_id}/delete', [CustomersController::class, 'delete']);
});

/**
 * Routes of products.
 */
Route::prefix('/products')->group(function(){

    Route::get('/{product_id}/detail', [ProductsController::class, 'detail']);

    Route::get('/{name?}/{description?}/{amount?}/{currentamount?}/{price?}', 
        [ProductsController::class, 'index']);

    Route::post('/create', [ProductsController::class, 'create']);

    Route::patch('/{product_id}/edit', [ProductsController::class, 'edit']);

    Route::delete('/{product_id}/delete', [ProductsController::class, 'delete']);
});

/**
 * Routes of orders.
 */
Route::prefix('/orders')->group(function(){

    Route::get('/{order_id}/detail', [OrdersController::class, 'detail']);

    Route::get('/{customer?}/{product?}/{value?}/{quantity?}/{status?}', 
        [OrdersController::class, 'index']);

    Route::post('/create', [OrdersController::class, 'create']);

    Route::patch('/{order_id}/edit', [OrdersController::class, 'edit']);

    Route::post('/{order_id}/opend', [OrdersController::class, 'putAsOpend']);

    Route::post('/{order_id}/paid', [OrdersController::class, 'putAsPaid']);

    Route::post('/{order_id}/canceled', [OrdersController::class, 'putAsCanceled']);

    Route::delete('/{order_id}/delete', [OrdersController::class, 'delete']);
});



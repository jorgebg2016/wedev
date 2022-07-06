<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        'customer_id',
        'product_id',
        'value',
        'quantity',
        'status_id',
    ];

    public function getCreatedAtAttribute($value): string {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value): string {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function status(): BelongsTo {

        return $this->belongsTo(Status::class, 'status_id');
    }

    public function customer(): BelongsTo {

        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product(): BelongsTo {

        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Search order by customer.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByCustomer(Builder $query, int $customer_id = 0): Builder
    {
        if($customer_id==0) return $query;
        
        return $query->where('customer_id', '=', $customer_id);
    }

    /**
     * Search order by product.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByProduct(Builder $query, int $product_id = 0): Builder
    {
        if($product_id==0) return $query;
        
        return $query->where('product_id', '=', $product_id);
    }

    /**
     * Search order by quantity.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByQuantity(Builder $query, int $quantity = 0): Builder
    {
        if($quantity==0) return $query;
        
        return $query->where('quantity', '=', $quantity);
    }

    /**
     * Search order by value.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByValue(Builder $query, int $value = 0): Builder
    {
        if($value==0) return $query;
        
        return $query->where('value', '=', $value);
    }

    /**
     * Search order by status.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByStatus(Builder $query, int $status = 0): Builder
    {
        if($status==0) return $query;
        
        return $query->where('status_id', '=', $status);
    }

    /**
     * Search customer by optional parameters.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearch(Builder $query, Request $request): Builder
    {
        return $query
            ->searchByCustomer($request->only('customer')? $request->only('customer')["customer"]: 0)
            ->searchByProduct($request->only('product')? $request->only('product')["product"]: 0)
            ->searchByQuantity($request->only('quantity')? $request->only('quantity')["quantity"]: 0)
            ->searchByValue($request->only('value')? $request->only('value')["value"]: 0)
            ->searchByStatus($request->only('status')? $request->only('status')["status"]: 0);
    }
}

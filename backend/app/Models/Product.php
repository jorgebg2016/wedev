<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;


class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'description',
        'amount',
        'price',
    ];

    protected $appends = array('current_amount');

    public function getCreatedAtAttribute($value): string {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value): string {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    
    /**
     * Mutator for amount.
     * 
     * @return int
     */
    public function getCurrentAmountAttribute(): int
    {
        $sold = 0;

        foreach($this->orders()->where('status_id', 1)->orWhere('status_id', 2)->get() as $order) {

            $sold += $order->quantity;
        }

        return $this->attributes["amount"] - $sold;
    }

    /**
     * Related orders
     */
    public function orders(): HasMany {

        return $this->hasMany(Order::class, 'product_id');
    }

    /**
     * Search product by name.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearchByName(Builder $query, string $name = ""): Builder
    {
        if(empty($name)) return $query;
        
        return $query->where('name', 'LIKE', "%".$name."%");
    }

    /**
     * Search product by description.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearchByDescription(Builder $query, string $description = ""): Builder
    {
        if(empty($description)) return $query;
        
        return $query->where('description', 'LIKE', "%".$description."%");
    }

    /**
     * Search product by amount.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByAmount(Builder $query, int $amount = null): Builder
    {
        if($amount==null) return $query;
        
        return $query->where('amount', '=', $amount);
    }

    /**
     * Search product by price.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByPrice(Builder $query, float $price = null): Builder
    {
        if($price==null) return $query;
        
        return $query->where('price', '=', $price);
    }

    /**
     * Search product by optional parameters.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearch(Builder $query, Request $request): Builder
    {
        return $query
            ->searchByName($request->only('name')? $request->only('name')["name"]: "")
            ->searchByDescription($request->only('description')? $request->only('description')["description"]: "")
            ->searchByAmount($request->only('amount')? $request->only('amount')["amount"]: null)
            ->searchByPrice($request->only('price')? $request->only('price')["price"]: null);
    }
}

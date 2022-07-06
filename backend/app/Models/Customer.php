<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = [
        'name',
        'cpf',
        'gender_id',
        'birthday',
        'email',
        'phone',
    ];

    protected $appends = array('formated_birthday');

    public function getFormatedBirthdayAttribute(): string {

        return Carbon::parse($this->attributes['birthday'])->format('d/m/Y');
    }

    public function getCreatedAtAttribute($value): string {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value): string {

        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    /**
     * Related gender.
     */
    public function gender(): BelongsTo {

        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * Related orders
     */
    public function orders(): HasMany {

        return $this->hasMany(Order::class, 'customer_id');
    }

    /**
     * Search customer by name.
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
     * Search customer by CPF.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearchByCPF(Builder $query, string $cpf = ""): Builder
    {
        if(empty($cpf)) return $query;
        
        return $query->where('cpf', 'LIKE', "%".$cpf."%");
    }

    /**
     * Search customer by gender.
     * 
     * @param int
     * 
     * @return Builder
     */
    public static function scopeSearchByGender(Builder $query, int $gender = 0): Builder
    {
        if($gender==0) return $query;
        
        return $query->where('gender_id', '=', $gender);
    }

    /**
     * Search customer by birthday.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearchByBirthday(Builder $query, string $birthday = ""): Builder
    {
        if(empty($birthday)) return $query;
        
        return $query->where('birthday', '=', $birthday);
    }

    /**
     * Search customer by email.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearchByEmail(Builder $query, string $email = ""): Builder
    {
        if(empty($email)) return $query;
        
        return $query->where('email', 'LIKE', "%".$email."%");
    }

    /**
     * Search customer by phone.
     * 
     * @param string
     * 
     * @return Builder
     */
    public static function scopeSearchByPhone(Builder $query, string $phone = ""): Builder
    {
        if(empty($phone)) return $query;
        
        return $query->where('phone', 'LIKE', "%".$phone."%");
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
            ->searchByName($request->only('name')? $request->only('name')["name"]: "")
            ->searchByCPF($request->only('cpf')? $request->only('cpf')["cpf"]: "")
            ->searchByGender($request->only('gender')? $request->only('gender')["gender"]: 0)
            ->searchByBirthday($request->only('birthday')? $request->only('birthday')["birthday"]: "")
            ->searchByEmail($request->only('email')? $request->only('email')["email"]: "")
            ->searchByPhone($request->only('phone')? $request->only('phone')["phone"]: "");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model {

    use HasFactory;

    public $timestamps = false;

    protected $table = "genders";

    protected $fillable = [
        'id',
        'name'
    ];

    public function customers(): HasMany {

        return $this->hasMany(Customer::class, 'gender_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "status";

    protected $fillable = [
        'id',
        'name'
    ];

    public function orders(): HasMany {

        return $this->hasMany(Order::class, 'status_id');
    }
}
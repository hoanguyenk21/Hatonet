<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apply extends Model
{
    use HasFactory;

    protected $table = 'apply';

    protected $fillable = [
        'name',
        'birthday',
        'avatar',
        'skill',
        'level',
        'rental_prices',
        'user_id',
        'product_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

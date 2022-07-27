<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_reviews extends Model
{
    use HasFactory;
    protected $table = 'customer_reviews';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
}

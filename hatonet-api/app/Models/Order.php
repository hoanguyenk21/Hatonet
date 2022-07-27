<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, QueryDefault, SoftDeletes;

    protected $table = "orders";

    const ORDER_STATUS = [
        'OPEN'            => 'pending',
        'PAYMENT_WAITING' => 'wait', // when service_end
        'PAYMENT_SUCCESS' => 'active',
        'CLOSE'           => 'suspended',
    ];

    protected $fillable = [
        'title',
        'description',
        'price_base',
        'price_sale',
        'qty',
        'user_id',
    ];


    /**
     * Return the created_at configuration array for this model.
     *
     * @return array
     */
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];

    
}

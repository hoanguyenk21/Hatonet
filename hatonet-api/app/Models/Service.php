<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    const SERVICE_STATUS = [
        'OPEN'            => 'pending',
        'PAYMENT_WAITING' => 'wait', // when service_end
        'PAYMENT_SUCCESS' => 'active',
        'CLOSE'           => 'suspended',
    ];

    protected $fillable = [
        'title',
        'description',
        'service_start',
        'service_end',
        'price_base',
        'price_sale',
        'qty',
        'status',
        'service_renew',
        'user_id',
        'use_time'
    ];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'service_start' => 'date:d-m-Y',
        'service_end' => 'date:d-m-Y',
    ];

    public function serviceMeta(){
        return $this->hasMany(ServiceMeta::class,'service_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function order(){
        return $this->hasMany(Order::class,'service_id');
    }
}

<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, QueryDefault;

    protected $table = "packages";

    const PACKAGE_STATUS = [
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
        'user_name',
        'service_id',
        'status',
        'start_day',
        'stop_day'
    ];
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function meta()
    {
        return $this->hasMany(PackageMeta::class, 'package_id');
    }
}

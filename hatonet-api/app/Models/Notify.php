<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notify extends Model
{
    use HasFactory, QueryDefault;

    protected $table = "notifies";

    const NOTIFY_RECIVE = [
        'ALL' => -1,
    ];

    const NOTIFY_TYPE = [
        'SYSTEM' => 'Hệ thống',
        'ORDER'  => 'Ứng tuyển',
        'ADS'    => 'Quảng cáo',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'user_receive',
        'user_id',
        'content',
        'actision'
    ];
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function users(){
        return $this->belongsTo(User::class , 'user_id');
    }
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];
}

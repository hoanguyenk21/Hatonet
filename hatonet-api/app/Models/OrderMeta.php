<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMeta extends Model
{
    use HasFactory;

    protected $table = 'order_meta';

    protected $fillable = [
        'meta_value',
        'meta_key',
        'order_id',
    ];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public $timestamps = false;
}

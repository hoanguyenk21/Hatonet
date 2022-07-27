<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryDefault;

class ProductMeta extends Model
{
    use HasFactory,QueryDefault;

    protected $table = 'product_meta';

    protected $fillable = [
        'meta_key',
        'meta_value',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public $timestamps = false;
}

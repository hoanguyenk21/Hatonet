<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, QueryDefault, Sluggable;

    protected $table = 'products';

    const PRODUCT_STATUS = [
        'PENDING' => 'pending', // cho xac nhan admin
        'WAITING' => 'wait',
        'PUBLISH' => 'active',
        'CLOSE'   => 'suspended',
    ];

    protected $fillable = [
        'title',
        'description',
        'content',
        'price_sale',
        'price_base',
        'price_other',
        'status',
        'user_id',
        'rating',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function taxonomy(){
        return $this->hasOne(Taxonomy::class,'id','taxonomy_id');
    }

    /**
    * Return the created_at configuration array for this model.
    *
    * @return array
    */
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
    ];

    public function productMeta(){
        return $this->hasMany(ProductMeta::class,'product_id');
    }

    public function term(){
        return $this->hasOne(Term::class,'id','term_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function reviews()
    {
        return $this->hasMany(Rating::class,'product_id');
    }
}

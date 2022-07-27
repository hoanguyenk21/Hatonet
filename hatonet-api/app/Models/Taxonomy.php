<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    use HasFactory, QueryDefault, Sluggable;

    protected $table = "taxonomies";

    const TAXONOMY_TYPE = [
        'POST' => 'post',
        'TICKET' => 'ticket',
        'PRODUCT' => 'product',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'type',
        'user_id',
    ];

    public $timestamps = false;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' =>  ['title', 'id'],
            ],
        ];
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
    public function posts(){
        return $this->hasMany(Post::class, 'taxonomy_id');
    }
}

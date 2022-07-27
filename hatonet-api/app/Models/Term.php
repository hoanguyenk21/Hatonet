<?php

namespace App\Models;

// use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Term extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'terms';

    const TERM_TYPE = [
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
   
    ];
    public function tag(){
        return $this->hasMany(Product::class, 'term_id');
    }
    public function posts(){
        return $this->hasMany(Post::class, 'term_id');
    }
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
                'source' => ['title', 'id'],
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
}
/**
 * Return the sluggable configuration array for this model.
 *
 * @return array
 */
// public function sluggable(): array
// {
//     return [
//         'slug' => [
//             'source' => ['title', 'id'],
//         ],
//     ];
// }



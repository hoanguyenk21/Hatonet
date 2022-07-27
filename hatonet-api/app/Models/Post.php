<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, QueryDefault, Sluggable;

    protected $table = 'posts';

    const POST_STATUS = [
        'PENDING' => 'pending', // cho xac nhan admin
        'PUBLISH' => 'active',
        'DRAFT' => 'wait',
        'REMOVE' => 'suspended',
    ];
    const POST_TYPE = [
        'POST' => 'post', // cho xac nhan admin
        'PAGE' => 'page',
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'image',
        'term_id',
        'user_id',
        'status',
        'taxonomy_id',
        'type'
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

    public function postMeta(){
        return $this->hasMany(PostMeta::class,'post_id', 'id');
    }

    public function taxonomy(){
        return $this->belongsTo(Taxonomy::class,'taxonomy_id');
    }

    public function term(){
        return $this->belongsTo(Term::class , 'term_id');
    }
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}

<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    use HasFactory,QueryDefault;

    protected $table = 'post_meta';

    protected $fillable = [
        'meta_value',
        'meta_key',
        'post_id',
    ];

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }

    public $timestamps = false;
}

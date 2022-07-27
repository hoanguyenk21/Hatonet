<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory, QueryDefault;

    protected $table = "media";

    const MEDIA_TYPE = [
        'IMAGE' => 'image',
        'FILE'  => 'file',
        'VIDEO' => 'video',
    ];

    protected $fillable = [
        'title',
        'image',
        'thumbnail',
        'path',
        'type',
        'user_id',
    ];
}

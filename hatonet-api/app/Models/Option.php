<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory, QueryDefault;

    protected $table = "options";

    protected $fillable = [
        'meta_key',
        'meta_value',
        'autoload',
    ];

    public $timestamps = false;

    protected $casts = [
        'autoload'   => 'boolean',
        'meta_value' => 'object',
    ];
}

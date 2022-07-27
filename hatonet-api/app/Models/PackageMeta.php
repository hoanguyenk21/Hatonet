<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageMeta extends Model
{
    use HasFactory;

    protected $table = 'package_meta';

    protected $fillable = [
        'meta_value',
        'meta_key',
        'package_id',
    ];

    public $timestamps = false;

    public function packages(){
        return $this->belongsTo(Package::class,'package_id');
    }
}

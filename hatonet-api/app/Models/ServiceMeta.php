<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMeta extends Model
{
    use HasFactory;

    protected $table = 'service_meta';

    protected $fillable = [
        'meta_value',
        'meta_key',
        'service_id',
    ];

    public $timestamps = false;

    public function services(){
        return $this->belongsTo(Service::class,'service_id');
    }
}

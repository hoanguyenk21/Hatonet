<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailRegister extends Model
{
    use HasFactory, QueryDefault;

    protected $table = "mailregister";

    protected $fillable = [
        'email',
    ];

    public $timestamps = true;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

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

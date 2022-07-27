<?php

namespace App\Models;

use App\Traits\QueryDefault;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, QueryDefault;

    const TICKET_STATUS = [
        'OPEN'    => 'pending',
        'DONE'    => 'active',
        'WAITING' => 'wait',
        'CONFIRM' => 'confirm',
        'CLOSE'   => 'suspended',
    ];

    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'description',
        'content',
        'slug',
        'user_id',
        'term_id',
        'status',
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
}

<?php

namespace App\Models;

use App\Models\UserMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_name',
        'email',
        'roles',
        'description',
        'password',
        'provider_id',
        'avatar',
        'phone',
        'status',
        'banner',
        'parent_id',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const USER_ROLES = [
        'ADMIN' => 'admin',
        'MANAGER' => 'manager',
        'MEMBER' => 'member',
        'COMPANY' => 'company',
    ];

    const USER_STATUS = [
        'PENDING' => 'pending',
        'ACTIVE' => 'active',
        'EXPIRED' => 'expired',
        'SUSPENDED' => 'suspended',
    ];
    public $timestamps = true;

    /**
     * Relation to Meta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta(): HasMany
    {
        return $this->hasMany(UserMeta::class,'user_id');
    }

    public function service(){
        return $this->hasMany(Service::class,'user_id');
    }

    public function order(){
        return $this->hasMany(Order::class, 'user_id');
    }

    public function product(){
        return $this->hasMany(Product::class, 'user_id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class,'company_id');
    }
     /**
    * Return the created_at configuration array for this model.
    *
    * @return array
    */
    protected $casts = [
        'created_at' => 'date:d-m-Y',
        'updated_at' => 'date:d-m-Y',
        'email_verified_at' => 'datetime',
    ];


}

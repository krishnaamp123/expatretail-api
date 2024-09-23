<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_group',
        'email',
        'password',
        'customer_name',
        'pic_name',
        'pic_phone',
        'address',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_group');
    }

    // /**
    //  * Get the group that belongs to user
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */

    //  public function group(): BelongsTo
    //  {
    //     return $this->belongsTo(Company::class, 'id_group', 'id')
    //  }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

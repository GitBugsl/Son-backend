<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Seller\SellerAccount;
use App\Models\Seller\SellerAdress;
use App\Models\User\UserAdress;
use App\Models\User\UserAccount;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasRoles , HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roletype',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function SellerAccount ()
    {
        return $this->hasOne(SellerAccount::class,'id');
    }

    public function SellerAdress ()
    {
        return $this->hasOne(SellerAdress::class,'id');
    }



    public function UserAdress ()
    {
        return $this->hasOne(UserAdress::class,'id');
    }


    public function UserAccount ()
    {
        return $this->hasOne(UserAccount::class,'id');
    }
}


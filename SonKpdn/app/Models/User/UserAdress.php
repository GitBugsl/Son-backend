<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class UserAdress extends Model
{
    use HasApiTokens,HasFactory, HasRoles;

    protected $fillable = [
        'UserCity',
        'UserCounty',
        'UserRegion',
        'UserId',
     ];

     protected $table = 'user_adresses';

     public function User()
     {
         return $this->belongsTo(User::class,'id');
     }
}



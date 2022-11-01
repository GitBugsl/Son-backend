<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class UserAccount extends Model
{
    use HasApiTokens,HasFactory,HasRoles;

    protected $fillable = [
        'UserNumber',
        'UserrName',
        'UserSurname',
        'UserPhoto',
        'UserId',
        'AgreementSeller',
    ];

    protected $table = 'user_accounts';

    protected $hidden = [
        'SupplierNumber',
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'id');
    }
}

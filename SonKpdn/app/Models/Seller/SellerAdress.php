<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class SellerAdress extends Model
{
    use HasApiTokens,HasFactory, HasRoles;

    protected $fillable = [
        'SupplierCity',
        'SupplierCounty',
        'SupplierRegion',
        'SupplierType',
        'SupplierId',
     ];

     protected $table = 'seller_adresses';

     public function User()
     {
         return $this->belongsTo(User::class,'id');
     }
}

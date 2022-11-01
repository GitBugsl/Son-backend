<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class SellerAccount extends Model
{
    use HasApiTokens,HasFactory,HasRoles;

    protected $fillable = [
        'SupplierShopName',
        'SupplierNumber',
        'SupplierName',
        'SupplierSurname',
        'SupplierShopType',
        'SupplierShopPhoto',
        'SupplierId',
        'SupplierShopInfo',
        'SupplierVkn',
        'SupplierVd',
        'SupplierIbank',
        'SupplierBankName',
        'AgreementSeller',
        'SupplierHolidayMode',
        'OpenEntegratorKey',
        'OpenEntegratorId',

    ];

    protected $table = 'seller_accounts';

    protected $hidden = [
        'OpenEntegratorKey',
        'OpenEntegratorİd',
        'SupplierVkn',
        'SupplierVd',
        'SupplierIbank',
        'SupplierBankName',
        'SupplierNumber',
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'id');
    }
}

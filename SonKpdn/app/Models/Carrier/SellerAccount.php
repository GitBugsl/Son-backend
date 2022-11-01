<?php

namespace App\Models\Carrier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class SellerAccount extends Model
{
    use HasFactory, HasRoles;
}

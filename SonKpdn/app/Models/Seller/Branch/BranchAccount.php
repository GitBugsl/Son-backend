<?php

namespace App\Models\Seller\Branch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class BranchAccount extends Model
{
    use HasFactory, HasRoles;
}

<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExternalServer extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];
}

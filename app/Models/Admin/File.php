<?php

namespace App\Models\Admin;

use App\Models\Membership\ExternalServer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public function ftp()
    {
        return $this->belongsTo(ExternalServer::class, 'external_server_id');
    }
    public function fileable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models\Admin\Map;

use App\Models\Admin\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded= ['id'];

    protected $casts = ['postal_address' => 'array', 'phone' => 'array'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

}

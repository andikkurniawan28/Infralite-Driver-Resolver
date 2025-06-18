<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function device(){
        return $this->belongsTo(Device::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function operation_system(){
        return $this->belongsTo(OperationSystem::class);
    }
}

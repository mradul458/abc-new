<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'member_name', 'date'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}


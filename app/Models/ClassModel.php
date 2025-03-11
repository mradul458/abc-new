<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = ['name', 'start_date', 'end_date', 'capacity'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'class_id');
    }
}


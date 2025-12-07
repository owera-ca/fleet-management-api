<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripDamage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_trip_damage';

    protected $fillable = [
        'description',
        'status',
        'trip_id',
        'driver_id',
        'program_id',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}

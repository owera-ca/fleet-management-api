<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truck extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_truck';

    protected $fillable = [
        'vin',
        'number_plate',
        'registered_at',
        'total_km',
        'status',
        'towing_capacity_kg',
        'length',
        'width',
        'height',
        'notes',
        'carrier_id',
        'program_id',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
    ];

    public function carrier()
    {
        // Assuming Carrier model will be created later, referencing Entity for now or placeholder
        // Based on migration, it references tbl_carrier. I will assume Carrier model.
        return $this->belongsTo(Carrier::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

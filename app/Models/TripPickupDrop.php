<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripPickupDrop extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_trip_pickup_drop';

    protected $fillable = [
        'type',
        'status',
        'sort_order',
        'trip_id',
        'cargo_id',
        'ship_address_id',
        'representative_address_id',
        'program_id',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function shipAddress()
    {
        return $this->belongsTo(ShipAddress::class, 'ship_address_id');
    }

    public function representativeAddress()
    {
        return $this->belongsTo(Address::class, 'representative_address_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}

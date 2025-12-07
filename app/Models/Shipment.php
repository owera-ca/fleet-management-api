<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_shipment';

    protected $fillable = [
        'status',
        'notes',
        'shipper_id',
        'origin_address_id',
        'destination_address_id',
        'program_id',
    ];

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    public function originAddress()
    {
        return $this->belongsTo(Address::class, 'origin_address_id');
    }

    public function destinationAddress()
    {
        return $this->belongsTo(Address::class, 'destination_address_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

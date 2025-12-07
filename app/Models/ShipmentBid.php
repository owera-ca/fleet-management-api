<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentBid extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_shipment_bid';

    protected $fillable = [
        'amount',
        'status',
        'notes',
        'shipment_id',
        'carrier_id',
        'program_id',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

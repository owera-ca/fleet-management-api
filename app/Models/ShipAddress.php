<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_ship_address';

    protected $fillable = [
        'address_id',
        'shipper_id',
        'program_id',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shipper()
    {
        // Assuming Shipper model exists or placeholder
        return $this->belongsTo(Shipper::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

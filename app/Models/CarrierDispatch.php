<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarrierDispatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_carrier_dispatch';

    protected $fillable = [
        'carrier_id',
        'dispatch_id',
        'program_id',
    ];

    public function carrier()
    {
        // Assuming Carrier model exists or placeholder
        return $this->belongsTo(Carrier::class);
    }

    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

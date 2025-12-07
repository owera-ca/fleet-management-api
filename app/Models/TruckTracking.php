<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckTracking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_truck_tracking';

    protected $fillable = [
        'lat',
        'lng',
        'truck_id',
        'program_id',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

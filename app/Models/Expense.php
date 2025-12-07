<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_expense';

    protected $fillable = [
        'description',
        'subtotal',
        'total',
        'status',
        'shipment_id',
        'driver_id',
        'program_id',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
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

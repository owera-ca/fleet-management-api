<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_cargo';

    protected $fillable = [
        'weight',
        'length',
        'width',
        'height',
        'notes',
        'shipment_id',
        'program_id',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

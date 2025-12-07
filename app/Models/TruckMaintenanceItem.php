<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckMaintenanceItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_truck_maintenance_item';

    protected $fillable = [
        'price',
        'qty',
        'composite_price',
        'truck_maintenance_id',
        'mst_line_item_id',
        'program_id',
    ];

    public function truckMaintenance()
    {
        return $this->belongsTo(TruckMaintenance::class);
    }

    public function lineItem()
    {
        return $this->belongsTo(LineItem::class, 'mst_line_item_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckMaintenance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_truck_maintenance';

    protected $fillable = [
        'subtotal',
        'total',
        'status',
        'notes',
        'mst_truck_maintenance_id',
        'truck_id',
        'shop_id',
    ];

    public function masterMaintenance()
    {
        return $this->belongsTo(MasterTruckMaintenance::class, 'mst_truck_maintenance_id');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTruckMaintenance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_truck_maintenence';

    protected $fillable = [
        'schedule_days',
        'schedule_km',
        'notes',
        'mst_line_item', // This seems to be a foreign key column name based on migration, but usually it's _id. Checking migration...
        // Migration says: $table->foreignId('mst_line_item')->nullable()->constrained('mst_line_item')
        // So the column name is indeed mst_line_item
        'program_id',
    ];

    public function lineItem()
    {
        return $this->belongsTo(LineItem::class, 'mst_line_item');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

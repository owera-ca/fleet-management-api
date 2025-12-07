<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_shop_job';

    protected $fillable = [
        'status',
        'notes',
        'shop_id',
        'truck_id',
        'program_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

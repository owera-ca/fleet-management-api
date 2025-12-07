<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_order_item';

    protected $fillable = [
        'price',
        'qty',
        'total',
        'order_id',
        'program_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

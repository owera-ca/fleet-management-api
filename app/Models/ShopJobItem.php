<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopJobItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_shop_job_item';

    protected $fillable = [
        'price',
        'qty',
        'composite_price',
        'shop_job_id',
        'mst_line_item_id',
        'program_id',
    ];

    public function shopJob()
    {
        return $this->belongsTo(ShopJob::class);
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

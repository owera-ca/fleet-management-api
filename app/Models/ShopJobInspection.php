<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopJobInspection extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_shop_job_inspection';

    protected $fillable = [
        'result',
        'notes',
        'shop_job_id',
        'program_id',
    ];

    public function shopJob()
    {
        return $this->belongsTo(ShopJob::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

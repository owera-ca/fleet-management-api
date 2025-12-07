<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_trans';

    protected $fillable = [
        'amount',
        'type',
        'status',
        'notes',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

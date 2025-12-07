<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_payroll_item';

    protected $fillable = [
        'amount',
        'type',
        'notes',
        'payroll_id',
        'program_id',
    ];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

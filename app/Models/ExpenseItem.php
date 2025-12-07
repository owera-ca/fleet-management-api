<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_expense_item';

    protected $fillable = [
        'price',
        'qty',
        'composite_price',
        'notes',
        'expense_id',
        'mst_line_item_id',
        'program_id',
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }

    public function lineItem()
    {
        return $this->belongsTo(LineItem::class, 'mst_line_item_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}

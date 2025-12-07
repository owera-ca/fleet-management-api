<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class LineItem extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;

    protected $table = 'mst_line_item';

    protected $fillable = [
        'name',
        'parent_id',
        '_lft',
        '_rgt',
        'depth',
        'price',
        'notes',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

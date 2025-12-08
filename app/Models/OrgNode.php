<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class OrgNode extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;

    protected $table = 'mst_orgnode';

    protected $fillable = [
        'name',
        'code',
        'root_id',
        'parent_id',
        '_lft',
        '_rgt',
        'depth',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

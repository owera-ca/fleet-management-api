<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_role';

    protected $fillable = [
        'name',
        'code',
        'notes',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

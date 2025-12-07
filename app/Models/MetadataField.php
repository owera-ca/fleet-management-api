<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetadataField extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_metadata';

    protected $fillable = [
        'code',
        'name',
        'external_id',
        'notes',
        'program_id',
        'mst_entity_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'mst_entity_id');
    }
}

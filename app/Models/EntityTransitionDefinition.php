<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityTransitionDefinition extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'def_entity_transition';

    protected $fillable = [
        'code',
        'name',
        'sort_order',
        'notes',
        'entity_id',
        'program_id',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

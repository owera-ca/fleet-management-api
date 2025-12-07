<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityTransition extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_entity_transition';

    protected $fillable = [
        'start_at',
        'end_at',
        'def_entity_transition_id',
        'entity_id',
        'start_by',
        'end_by',
        'program_id',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function transitionDefinition()
    {
        return $this->belongsTo(EntityTransitionDefinition::class, 'def_entity_transition_id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function startBy()
    {
        return $this->belongsTo(User::class, 'start_by');
    }

    public function endBy()
    {
        return $this->belongsTo(User::class, 'end_by');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

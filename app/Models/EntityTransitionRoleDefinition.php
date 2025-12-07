<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityTransitionRoleDefinition extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'def_entity_transition_role';

    protected $fillable = [
        'notes',
        'def_entity_transition_id',
        'role_id',
        'program_id',
    ];

    public function transitionDefinition()
    {
        return $this->belongsTo(EntityTransitionDefinition::class, 'def_entity_transition_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

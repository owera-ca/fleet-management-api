<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntityRoleDefinition extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'def_entity_role';

    protected $fillable = [
        'notes',
        'entity_id',
        'role_id',
        'program_id',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
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

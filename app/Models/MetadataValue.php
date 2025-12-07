<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetadataValue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_metadata';

    protected $fillable = [
        'value',
        'metadata_id',
        'entity_id',
        'program_id',
    ];

    public function metadataField()
    {
        return $this->belongsTo(MetadataField::class, 'metadata_id');
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

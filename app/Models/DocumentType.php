<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_document';

    protected $fillable = [
        'code',
        'name',
        'notes',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

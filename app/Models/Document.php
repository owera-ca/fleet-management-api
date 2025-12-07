<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_document';

    protected $fillable = [
        'filename',
        'encrypted_filename',
        'type',
        'type_id',
        'notes',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

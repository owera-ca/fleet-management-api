<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_asset';

    protected $fillable = [
        'content_type',
        'filename',
        'encrypted_filename',
        'is_sensitive',
        'program_id',
    ];

    protected $casts = [
        'is_sensitive' => 'boolean',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_sms_template';

    protected $fillable = [
        'sms_body_text',
        'sms_body_params',
        'notes',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

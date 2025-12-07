<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sms extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_sms';

    protected $fillable = [
        'body',
        'status',
        'try_counter',
        'context',
        'sms_template_id',
        'program_id',
    ];

    public function smsTemplate()
    {
        return $this->belongsTo(SmsTemplate::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

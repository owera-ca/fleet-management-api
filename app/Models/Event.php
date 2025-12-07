<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_event';

    protected $fillable = [
        'event_name',
        'event_code',
        'roles',
        'send_email',
        'send_sms',
        'notes',
        'program_id',
        'email_template_id',
        'sms_template_id',
    ];

    protected $casts = [
        'send_email' => 'boolean',
        'send_sms' => 'boolean',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function emailTemplate()
    {
        return $this->belongsTo(EmailTemplate::class);
    }

    public function smsTemplate()
    {
        return $this->belongsTo(SmsTemplate::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_email';

    protected $fillable = [
        'subject',
        'body',
        'attachments',
        'status',
        'try_counter',
        'context',
        'email_template_id',
        'program_id',
    ];

    public function emailTemplate()
    {
        return $this->belongsTo(EmailTemplate::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

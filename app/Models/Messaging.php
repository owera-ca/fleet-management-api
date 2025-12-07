<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messaging extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_messaging';

    protected $fillable = [
        'sent_at',
        'read_at',
        'message',
        'from_role_id',
        'from_user_id',
        'to_role_id',
        'to_user_id',
        'read_by',
        'program_id',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function fromRole()
    {
        return $this->belongsTo(Role::class, 'from_role_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toRole()
    {
        return $this->belongsTo(Role::class, 'to_role_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function readBy()
    {
        return $this->belongsTo(User::class, 'read_by');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

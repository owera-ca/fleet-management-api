<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_address';

    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'alt_email',
        'phone',
        'alt_phone',
        'addr1',
        'addr2',
        'postal_zip',
        'notes',
        'program_id',
        'country_id',
        'province_state_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_state_id');
    }
}

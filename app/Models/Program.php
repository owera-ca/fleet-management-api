<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_program';

    protected $fillable = [
        'name',
        'code',
        'company_address_id',
        'representative_address_id',
    ];

    public function companyAddress()
    {
        return $this->belongsTo(Address::class, 'company_address_id');
    }

    public function representativeAddress()
    {
        return $this->belongsTo(Address::class, 'representative_address_id');
    }
}

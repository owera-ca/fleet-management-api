<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_province';

    protected $fillable = [
        'name',
        'iso3_code',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

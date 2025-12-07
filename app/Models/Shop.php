<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Shop extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;

    protected $table = 'tbl_shop';

    protected $fillable = [
        'shop_name',
        'parent_id',
        '_lft',
        '_rgt',
        'depth',
        'program_id',
        'shop_address_id',
        'representative_address_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function shopAddress()
    {
        return $this->belongsTo(Address::class, 'shop_address_id');
    }

    public function representativeAddress()
    {
        return $this->belongsTo(Address::class, 'representative_address_id');
    }
}

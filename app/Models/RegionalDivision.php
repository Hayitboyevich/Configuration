<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalDivision extends Model
{
    use HasFactory;
    protected $table = 'regional_division';
    public $timestamps = false;

    protected $fillable = [
        'title_uz',
        'title_oz',
        'title_uz',
        'title_uz',
        'position_uz',
        'position_oz',
        'position_ru',
        'position_en',
        'reception_day_uz',
        'reception_day_oz',
        'reception_day_ru',
        'reception_day_en',
        'address_uz',
        'address_oz',
        'address_uz',
        'address_uz',
        'content_uz',
        'content_oz',
        'content_uz',
        'content_uz',
        'email',
        'phone_number',
        'map_id',
        'map_coordinate_x',
        'map_coordinate_y',
        'alias',
        'region_id',
        'status',
    ];

}

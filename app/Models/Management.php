<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

    protected $table = 'management';
    public $timestamps = false;

    protected $fillable = [
        'name_uz',
        'name_oz',
        'name_uz',
        'name_uz',
        'email',
        'phone_number',
        'position_uz',
        'position_oz',
        'position_ru',
        'position_en',
        'reception_day_uz',
        'reception_day_oz',
        'reception_day_ru',
        'reception_day_en',
        'img',
        'region_id',
        'status',
    ];

}

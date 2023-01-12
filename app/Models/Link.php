<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $table = 'useful_url';
    public $timestamps = false;

    protected $fillable = [
        'title_uz',
        'title_oz',
        'title_uz',
        'title_uz',
        'url_uz',
        'url_oz',
        'url_ru',
        'url_en',
        'img',
        'region_id',
        'status',
    ];
}

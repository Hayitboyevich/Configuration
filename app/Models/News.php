<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    public $timestamps = false;

    protected $fillable = [
        'title_uz',
        'title_oz',
        'title_uz',
        'title_uz',
        'content_uz',
        'content_oz',
        'content_ru',
        'content_en',
        'view_count',
        'date',
        'banner',
        'alias_uz',
        'alias_oz',
        'alias_ru',
        'alias_en',
        'on_main',
        'region_id',
        'status',
    ];
}

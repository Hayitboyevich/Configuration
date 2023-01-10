<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsFile extends Model
{
    use HasFactory;

    protected $table = 'news_file';
    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'file',
        'status',
    ];
}

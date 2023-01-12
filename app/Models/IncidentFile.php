<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentFile extends Model
{
    use HasFactory;

    protected $table = 'incident_file';
    public $timestamps = false;

    protected $fillable = [
        'incident_id',
        'file',
        'status',
    ];
}

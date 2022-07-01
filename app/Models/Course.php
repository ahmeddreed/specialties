<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'details',
        'br_lng',
        'FW_link',
        'A_link',
        'E_link',
        'uploader',
        'updater',
        'visits',
    ];
}

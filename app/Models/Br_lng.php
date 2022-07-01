<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Br_lng extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'branch_id',
        'language_id',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'profile_picture',
        'birth_certificate',
        'letter',
        'center_id',
        'region_id'
    ];
}
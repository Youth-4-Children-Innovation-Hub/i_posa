<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'region_id',
        'hod_id'
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * Set the attribute value with first letter of each word capitalized.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return void
     */
    public function setAttribute($attribute, $value)
    {
        if (in_array($attribute, $this->capitalizeAttributes)) {
            parent::setAttribute($attribute, ucwords(strtolower($value)));
        } else {
            parent::setAttribute($attribute, $value);
        }
    }

    /**
     * Get the attributes that should be capitalized.
     *
     * @return array
     */
    public function getCapitalizeAttributesAttribute()
    {
        return ['name'];
    }

    use HasFactory;
}

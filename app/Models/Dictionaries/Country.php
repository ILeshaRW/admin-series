<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class Country extends Model
{
    protected $fillable = [
        'name',
    ];
}

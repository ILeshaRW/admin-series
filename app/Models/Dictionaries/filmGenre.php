<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class filmGenre extends Model
{
    protected $fillable = [
        'name',
    ];
}

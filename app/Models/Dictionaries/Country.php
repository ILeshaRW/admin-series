<?php

namespace App\Models\Dictionaries;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $name
 */
class Country extends Model
{
    use AsSource;

    protected $fillable = [
        'name',
    ];
}

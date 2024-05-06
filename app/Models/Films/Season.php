<?php

namespace App\Models\Films;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $release_date
 */
class Season extends Model
{
    protected $fillable = [
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];
}

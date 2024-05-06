<?php

namespace App\Models\Films;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property ?string $description
 * @property Carbon $release_date
 */
class Episode extends Model
{
    protected $fillable = [
        'name',
        'description',
        'episode_number',
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];
}

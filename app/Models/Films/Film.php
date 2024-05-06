<?php

namespace App\Models\Films;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property ?string $description
 * @property Carbon $release_date
 * @property ?Carbon $closing_date
 */
class Film extends Model
{
    protected $fillable = [
        'name',
        'description',
        'release_date',
        'closing_date',
    ];

    protected $casts = [
        'release_date' => 'date',
        'closing_date' => 'date',
    ];
}

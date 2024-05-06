<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $slug - символьный код роли
 */
class Role extends Model
{
    protected $fillable = [
        'slug',
    ];
}

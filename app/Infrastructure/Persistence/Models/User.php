<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * {@inheritDoc}
 *
 * @property int $id
 * @property string $name
 * @property array $links
 */
class User extends Authenticatable
{
    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }
}

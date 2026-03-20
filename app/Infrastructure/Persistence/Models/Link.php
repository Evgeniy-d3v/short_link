<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * {@inheritDoc}
 *
 * @property int $id
 * @property string $short_link
 * @property string $long_link
 * @property int $user_id
 * @property User $user
 */
class Link extends Model
{
    protected $table = 'links';

    protected $fillable = [
        'long_link',
        'short_link',
        'user_id',
    ];

    protected $casts = [
        'long_link' => 'string',
        'short_link' => 'string',
        'user_id' => 'int',
    ];

    public function linkVisits(): HasMany
    {
        return $this->hasMany(LinkVisit::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * {@inheritDoc}
 *
 * @property int $id
 * @property string $ip
 * @property string $user_agent
 * @property Carbon $visited_at
 * @property Link $link
 */
class LinkVisit extends Model
{
    protected $fillable = [
        'ip',
        'user_agent',
        'visited_at',
        'link_id',
    ];

    protected $casts = [
        'ip' => 'string',
        'user_agent' => 'string',
        'visited_at' => 'datetime',
        'link_id' => 'int',
    ];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}

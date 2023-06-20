<?php

namespace Zploited\Heimdall\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Access token entity
 *
 * @property string $id
 * @property string $subject
 * @property string $client_id
 * @property Collection $scope
 * @property Carbon $created_at
 * @property Carbon $expires_at
 * @property Carbon|null $not_before
 * @property Carbon|null $revoked_at
 */
class AccessToken extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['subject', 'client_id', 'scope', 'expires_at', 'not_before'];
    protected $casts = [
        'scope' => 'collection',
        'created_at' => 'date',
        'expires_at' => 'date',
        'not_before' => 'date',
        'revoked_at' => 'date'
    ];
}
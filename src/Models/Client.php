<?php

namespace Zploited\Heimdall\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Zploited\Heimdall\Framework\OauthAuthenticatable;

/**
 * Client entity
 *
 * Represents a client in the database, used to identify a specific application, while granting access to it.
 *
 * @property string $id
 * @property string $secret
 * @property string $name
 * @property Collection $redirect_uri
 * @property boolean $allow_skip_consent
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Client extends OauthAuthenticatable
{
    protected $fillable = ['name', 'redirect_uri', 'allow_skip_consent', 'secret'];
    protected $hidden = ['secret'];
    protected $casts = [
        'redirect_uri' => 'collection',
        'secret' => 'encrypted'
    ];

    protected static function booted()
    {
        parent::booted();

        static::creating(function(Client $client) {
            $client->id = Str::random(32);

            if(!$client->redirect_uri) {
                $client->redirect_uri = new Collection();
            }
        });
    }
}
<?php

namespace Zploited\Heimdall\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use phpseclib3\Crypt\RSA;
use phpseclib\Crypt\RSA as LegacyRSA;

/**
 * Certificate entity
 * Represents a certificate in the database.
 *
 * @property int $id
 * @property string $public
 * @property string $private
 * @property Carbon $created_at
 * @property Carbon $revoked_at
 */
class Certificate extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $hidden = ['private'];
    protected $casts = [
        'created_at' => 'datetime',
        'revoked_at' => 'datetime',
        'private' => 'encrypted'
    ];

    protected static function booted()
    {
        parent::booted();

        static::creating(function(Certificate $certificate) {
            $certificate->created_at = Carbon::now();

            // generating keys
            if(class_exists(LegacyRSA::class)) {
                $keys = (new LegacyRSA())->createKey(4096);

                $certificate->private = Arr::get($keys, 'privatekey');
                $certificate->public = Arr::get($keys, 'publickey');
            } else {
                $key = RSA::createKey(4096);
                $certificate->private = (string)$key;
                $certificate->public = (string)$key->getPublicKey();
            }
        });
    }
}
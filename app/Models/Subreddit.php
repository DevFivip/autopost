<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property integer $id
 * @property string $name
 * @property string $tags
 * @property boolean $verification
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property Customer[] $customers
 */
class Subreddit extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'tags', 'verification', 'status', 'created_at', 'updated_at'];
    protected $casts = ['verification' => 'boolean', 'status' => 'boolean'];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value, array $attributes) =>  $attributes['name'] . " (" . $attributes['tags'] . ")"

        )->shouldCache();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer', 'customer_subreddits');
    }
}

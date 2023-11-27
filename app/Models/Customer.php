<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $fullname
 * @property string $email
 * @property string $reddit_username
 * @property string $reddit_password
 * @property string $reddit_clientId
 * @property string $reddit_clientSecret
 * @property string $imgur_username
 * @property string $imgur_password
 * @property string $imgur_clientId
 * @property string $imgur_clientSecret
 * @property string $telegram_channel
 * @property string $tags
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Customer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'fullname', 'email', 'reddit_username', 'reddit_password', 'reddit_clientId', 'reddit_clientSecret', 'imgur_username', 'imgur_password', 'imgur_clientId', 'imgur_clientSecret', 'telegram_channel', 'tags', 'status', 'created_at', 'updated_at'];
    protected $casts = ['status' => 'boolean'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public static function myCustomers()
    {
       return self::where('user_id',auth()->user()->id)->get();
    }
}

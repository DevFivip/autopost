<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $customer_id
 * @property integer $subreddit_id
 * @property integer $telegram_channel_id
 * @property integer $post_type_id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $local_media_file
 * @property string $posted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 * @property Subreddit $subreddit
 * @property User $user
 * @property PostType $postType
 * @property TelegramChannel $telegramChannel
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'customer_id', 'subreddit_id', 'telegram_channel_id', 'post_type_id', 'title', 'description', 'link', 'local_media_file', 'posted_at', 'created_at', 'updated_at','status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subreddit()
    {
        return $this->belongsTo('App\Models\Subreddit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postType()
    {
        return $this->belongsTo('App\Models\PostType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function telegramChannel()
    {
        return $this->belongsTo('App\Models\TelegramChannel');
    }
}

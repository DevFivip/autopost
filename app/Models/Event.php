<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $customer_id
 * @property integer $subreddit_id
 * @property integer $status
 * @property string $posted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Subreddit $subreddit
 * @property Customer $customer
 */
class Event extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'customer_id', 'subreddit_id','post_id', 'status', 'posted_at', 'created_at', 'updated_at'];

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
    public function subreddit()
    {
        return $this->belongsTo('App\Models\Subreddit');
    }

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
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}

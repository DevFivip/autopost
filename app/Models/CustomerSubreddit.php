<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $customer_id
 * @property integer $subreddit_id
 * @property Subreddit $subreddit
 * @property Customer $customer
 */
class CustomerSubreddit extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'subreddit_id', 'user_id', 'verification_status'];
    public $timestamps = false;
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
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

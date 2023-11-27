<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property string $name
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property Post[] $posts
 * @property Customer $customer
 */
class TelegramChannel extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'user_id','name','tags', 'status', 'created_at', 'updated_at'];
    protected $casts = ['status'=>'boolean'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property string $name
 * @property string $tags
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 */
class Image extends Model implements HasMedia
{
    use InteractsWithMedia;
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'name', 'tags', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}

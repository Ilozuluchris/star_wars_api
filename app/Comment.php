<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'film_episode_id',
        'content',
        'commenter_ip',
    ];

    public $timestamps = false;

    //todo validation for input

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->setCreatedAt($model->freshTimestamp());
        });
    }
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];
    public static function upvote(Post $post)
    {
        static::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'vote' => 1
        ]);

        $post->score = 1;

        $post->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    public function getPublishedPosts(){
        $posts = Post::latest('published_at')
                -> where('published_at', '<=', Carbon::now())
                -> get();
        return $posts;
    }
}

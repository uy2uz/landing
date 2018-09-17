<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    //
    public function index(Post $postModel){
        
        //$posts = Post::all();
        
        $posts = $postModel->getPublishedPosts();
        return view('post.index',['posts' => $posts]);
    }
}

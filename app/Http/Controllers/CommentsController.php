<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Comment;

class CommentsController extends Controller
{
    public function addComment(Request $request){
        $comment =$request->input('comment');
        $articles_id = (int)$request->input('articles_id');
        $user_id = auth()->user()->id;
        
        $objComment = new Comment();
        $objComment = $objComment->create([
            'articles_id' => $articles_id,
            'user_id' => $user_id,
            'comment' => $comment
        ]);
        
        if($objComment){
            return back();
        }
        return back();
    }
}

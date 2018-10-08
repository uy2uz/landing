<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    public function addComment(CommentRequest $request){
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
            return back()->with('success', 'Комментарий отправлен на модерацию.');
        }
        return back()->with('error');
    }
}

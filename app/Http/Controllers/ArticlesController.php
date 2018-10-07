<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Article;
use App\Entities\User;

class ArticlesController extends Controller
{
    public function index(){
        $objArticle = new Article();
        $articles = $objArticle->orderBy('id','desc')->paginate(10);
        
        return view('index', ['articles' => $articles]);
    }
    
    public function showArticle(int $id, $slug){
        $objArticle = new Article();
        $objArticle = $objArticle->find($id);
        if(!$objArticle){
            return abort(404);
        }
        $comments = $objArticle->comments()->where('status', 1)->get();
        ($comments);
        return view('show_comments', ['article' => $objArticle,'comments' => $comments]);
    }
}


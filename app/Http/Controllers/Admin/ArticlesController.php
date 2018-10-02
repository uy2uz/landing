<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Category;

class ArticlesController extends Controller
{
    public function index(){
        
    }
    
    public function addArticle(){
        $objCategory = new Category();
        $categories = $objCategory->get();
                        
        return view ('admin.articles.add',['categories' =>$categories]);
    }
    public function addRequestArticle(ArticleRequest $request){
        dd($request->all());
    }

        public function editArticle(int $id){
        
    }
    
    public function deleteArticle(Request $request){
        
    }
}

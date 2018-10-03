<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Category;
use App\Entities\Article;
use App\Entities\CategoryArticle;

class ArticlesController extends Controller
{
    public function index(){
        $objArticle = new Article();
        $articles = $objArticle->get();
        
        return view('admin.articles.index',['articles' => $articles]);
    }
    
    public function addArticle(){
        $objCategory = new Category();
        $categories = $objCategory->get();
                        
        return view ('admin.articles.add',['categories' => $categories]);
    }
    public function addRequestArticle(ArticleRequest $request){
        $objArticle = new Article();
        $objCategoryArticle = new CategoryArticle();
        
        $objArticle = new Article();
        $objArticle = $objArticle->create([
            'title'      => $request->input('title'),
            'author'     => $request->input('author'),
            'short_text' => $request->input('short_text'),
            'full_text'  => $request->input('full_text')
        ]);
                
        if($objArticle){
            foreach($request->input('categories') as $category_id){
                $category_id = (int)$category_id;
                $objCategoryArticle = $objCategoryArticle->create([
                    'category_id' => $category_id,
                    'articles_id' => $objArticle->id,
                ]);
            }
            return redirect()->route('articles')->with('success', 'Статья добавлена!');
        }
        return back()->with('error','Не удалось добавить статью!');
    }

        public function editArticle(int $id){
            $objCategory = new Category();
            $categories = $objCategory->get();
            
            $objArticle = Article::find($id);
            if(!$objArticle){
                return abort(404);
            }
                                    
            return view ('admin.articles.edit',[
                'categories' => $categories,
                'article' => $objArticle
            ]);
    }
    
    public function deleteArticle(Request $request){
        
    }
}

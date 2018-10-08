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
        
        //$objArticle = new Article();
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
            $mainCategories = $objArticle->categories;
            $arrCategories = [];
            foreach($mainCategories as $category){
                $arrCategories[] = $category->id;
            }
            
            return view ('admin.articles.edit',[
                'categories' => $categories,
                'article' => $objArticle,
                'arrCategories' => $arrCategories,
            ]);
    }
    
    public function editRequestArticle(int $id, ArticleRequest $request){
        $objArticle = Article::find($id);
        
        if(!$objArticle){
            return abort(404);
        }
        $objArticle->title = $request->input('title');
        $objArticle->author = $request->input('author');
        $objArticle->short_text = $request->input('short_text');
        $objArticle->full_text = $request->input('full_text');
        
        if($objArticle->save()){
            //Обновляем категории
            $objArticleCategory = new CategoryArticle();
            $objArticleCategory->where('articles_id', $objArticle->id)->delete();
            
            $arrCategories = $request->input('categories');
            if(is_array($arrCategories)){
                foreach($arrCategories as $category){
                    $objArticleCategory->create([
                        'category_id' => $category,
                        'articles_id' => $objArticle->id
                    ]);
                }
            }
            
            return redirect()->route('articles')->with('success', 'Статья оновлена!');
        }
        return back()->with('error','Не удалось обновить статью!');
    }


    public function deleteArticle(Request $request){
        if($request->ajax()){
            $id = (int)$request->input('id');
            $objArticle = new Article();
            $objArticle->where('id', $id)->delete();
            echo 'success';
        }
    }
}

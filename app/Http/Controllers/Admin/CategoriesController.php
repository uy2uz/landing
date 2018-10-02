<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Category;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    public function index(){
        $objCategory = new Category();
        $categories = $objCategory->get();
        return view('admin.categories.index',['categories' => $categories]);
        
    }
    
    public function addCategory() {
        return view('admin.categories.add');
    }
    public function addRequestCategory(Request $request){
        
        try{
            $this->validate($request, [
               'title' => 'required|string|min:2|max:15',
                'description' => 'required|string|min:1|max:5000'
            ]);
            $objCategory = new Category();
            $objCategory = $objCategory->create([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);
            if($objCategory){
                return redirect()->route('categories')->with('success', "Категория {$request->title} успешно создана");
            }
            return back()->with('error', 'Ошибка, при создании категории');
        }catch(ValidationException $e){
            \Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function editCategory(int $id) {
        $category = Category::find($id);
        if(!$category){
            return abort(404);
        }
        return view('admin.categories.edit', ['category' => $category]);
    }
    public function editRequestCategory(Request $request, int $id){
        try{
            $this->validate($request, [
               'title' => 'required|string|min:2|max:15',
                'description' => 'required|string|min:1|max:5000'
            ]);
            $objCategory = Category::find($id);
                if(!$objCategory){
                    return route('categories')->with('error', 'Ошибка, при редактировании категории');
            }
            $objCategory->title = $request->input('title');
            $objCategory->description = $request->input('description');
            
            if($objCategory->save()){
                return redirect()->route('categories')->with('success', "Категория {$request->title} успешно отредактирована");
            }
            return route('categories')->with('error', 'Ошибка, при редактировании категории');
            
        }catch(ValidationException $e){
            \Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

        public function deleteCategory(Request $request) {
            dd($request);
        if($request->ajax()){
            $id = (int)$request->input('id');
            $objCategory = new Categore();
            $objCategory->where('id', $id)->delete();
            echo 'success';
        }
    }
            
}

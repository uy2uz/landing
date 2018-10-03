<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'],function(){
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
});
//account
Route::group(['middleware' => 'auth'],function(){
    Route::get('/my/account', 'AccountController@index')->name('account');
    Route::get('/logout', function(){
        \Auth::logout();
        return redirect(route('login'));
    })->name('logout');
//Admin
    Route::group(['middleware' => 'admin', 'prefix' => 'admin'],function(){    
        Route::get('/admin', 'Admin\AccountController@index')->name('admin');
        /*категории*/
        Route::get('/categories', 'Admin\CategoriesController@index')->name('categories');
        Route::get('/categories/add', 'Admin\CategoriesController@addCategory')->name('categories.add');
        Route::post('/categories/add', 'Admin\CategoriesController@addRequestCategory');
        Route::get('/categories/edit/{id}', 'Admin\CategoriesController@editCategory')->where('id','\d+')->name('categories.edit');
        Route::post('/categories/edit/{id}', 'Admin\CategoriesController@editRequestCategory')->where('id','\d+')->name('categories.edit');
        Route::delete('categories/delete', 'Admin\CategoriesController@deleteCategory')->name('categories.delete');
        /*Статьи*/
        Route::get('/articles', 'Admin\ArticlesController@index')->name('articles');
        Route::get('/articles/add', 'Admin\ArticlesController@addArticle')->name('articles.add');
        Route::post('/articles/add', 'Admin\ArticlesController@addRequestArticle');
        Route::get('/articles/edit/{id}', 'Admin\ArticlesController@editArticle')->where('id','\d+')->name('articles.edit');
        Route::post('/articles/edit/{id}', 'Admin\ArticlesController@editRequestArticle')->where('id','\d+');
        Route::delete('/articles/delete/', 'Admin\ArticlesController@deleteArticle')->name('articles.delete');;
    });
});

    


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
//index blog
Route::get('/', 'ArticlesController@index')->name('blog');
//blog
Route::get('/article/{id}/{slug}.html','ArticlesController@showArticle')->where('id', '\d')->name('blog.show');

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
    //Comments
    Route::post('/comments/add', 'CommentsController@addComment')->name('comments.add');
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
        Route::delete('/articles/delete/', 'Admin\ArticlesController@deleteArticle')->name('articles.delete');
        /*Пользователи*/
        Route::get('/users', 'Admin\UsersController@index')->name('users');
        Route::delete('/user/delete/', 'Admin\UsersController@deleteUser')->name('users.delete');
        /*Модерация кромментариев*/
        Route::get('/comments', 'Admin\CommentsController@index')->name('comments');
        Route::get('/comments/accepted/{id}', 'Admin\CommentsController@acceptComment')->where('id','\d+')->name('comment.accepted');
        Route::delete('/comments/delete/', 'Admin\CommentsController@deleteComment')->name('comments.delete');
    });
});

    


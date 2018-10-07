<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Comment;

class Article extends Model
{
    protected $table = "articles";
    protected $primaryKey = "id";
    
    protected $fillable = [
        'title',
        'author',
        'short_text',
        'full_text'
    ];
    protected $dates = [
        'created_at', 'updatet_at'
    ];
    //Relations
    public function categories(){
        return $this->belongsToMany(Category::class,'category-articles','articles_id', 'category_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'articles_id', 'id');
    }
}

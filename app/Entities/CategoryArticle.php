<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryArticle extends Model
{
    protected $table = "category-articles";
    protected $primaryKey = "id";
    
    protected $fillable = [
        'category_id',
        'articles_id'

    ];
    protected $dates = [
        'created_at', 'updatet_at'
    ];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category', 'article_id', 'category_id');
    }
}

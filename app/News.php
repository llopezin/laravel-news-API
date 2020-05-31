<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'id',
        'title',
        'author_id',
        'date-published',
        'content',
        'imgURL',
        'category_id'
    ];
}

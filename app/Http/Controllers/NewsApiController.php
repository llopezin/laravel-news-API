<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Author;
use App\Category;

class NewsApiController extends Controller
{

    public function getNewsByPage(Request $request)
    {
        $page = $request->get('page');

        if ($page <= 10) {
            $news = News::paginate(10, ['id', 'title',  'date-published']);
            return response($news, 200);
        } else {
            return response()->json([
                "message" => "Page not found"
            ], 404);
        }
    }

    public function getNewsById(News $id)
    {
        //now $id refers to News row article with given id
        if ($id) {
            $author_id = Author::whereId($id->author_id)->get("author");
            $category_id = Category::whereId($id->category_id)->get("category");

            $article = [
                "id" => $id->id,
                "title" => $id->title,
                "date-published" => $id->{'date-published'},
                "author" => $author_id[0]->author,
                "content" => $id->content,
                "imgURL" => $id->imgURL,
                "category" => $category_id[0]->category
            ];


            return response($article, 200);
        } else {
            return response()->json([
                "message" => "Article not found"
            ], 404);
        }
    }

    public function getNewsByCategory(Category $id)
    {
        if ($id) {
            $news = News::select('id', 'title',  'date-published')->where("category_id", "=", $id->id)->paginate(10);

            //prevents integrated pagination from returning empty pages
            if ($news->isEmpty()) {
                return  response()->json([
                    "message" => "Page not found"
                ], 404);
            } else {
                return response($news, 200);
            }
        } else {
            return response()->json([
                "message" => "Category id not found"
            ], 404);
        }
    }

    public function getNewsByAuthor(Author $id)
    {
        if ($id) {
            $news = News::select('id', 'title', 'date-published')->whereAuthor_id($id->id)->get();

            return $news;
        } else {
            return response()->json([
                "message" => "Author id not found"
            ], 404);
        }
    }
}

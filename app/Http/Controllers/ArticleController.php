<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    function allArticles()
    {
        return Article::all();
    }

    function getArticle(Article $article)
    {
        return $article;
    }

    function createArticle(Request $request)
    {
        $user = $request->user();
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = $user->id;
        $article->save();
        return $article;
    }

    function updateArticle(Request $request, Article $article)
    {
        $user = $request->user();
        if ($user->id != $article->user_id) {
            return response()->json(["error" => "You do not have permission to edit this article"], 404);
        } else {
            $article->title = $request->title;
            $article->content = $request->content;
            $article->save();
            return $article;
        }
    }

    function deleteArticle(Request $request, Article $article)
    {
        $user = $request->user();
        if ($user->id != $article->user_id) {


            return response()->json(["error" => "You do not have permission to delete this article"], 404);
        } else {
            $article->delete();
            return response()->json(["success" => "successfully deleted the article"], 200);
        }
    }
}

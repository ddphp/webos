<?php

namespace App\Http\Controllers\Wx\User;

use App\Models\Admin\Article as ArticleModel;
use App\Http\Controllers\Controller;

class Article extends Controller
{
    public function index(ArticleModel $article)
    {
        return view('wx.user.article', compact('article'));
    }
}

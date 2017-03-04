<?php

namespace App\Http\Controllers\Wx\User;

use App\Models\Admin\Article as ArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Article extends Controller
{
    public function index(Request $request, ArticleModel $article)
    {
        return view('wx.user.article', compact('article'));
    }
}

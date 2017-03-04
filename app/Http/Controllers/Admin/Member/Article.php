<?php

namespace App\Http\Controllers\Admin\Member;

use App\Models\Admin\Article as ArticleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Article extends Controller
{
    public function index(Request $request, $id)
    {
        $article = ArticleModel::findOrFail($id);

        $url = route('admin.member.article_store');

        return view('admin.member.article', compact('article', 'url'));
    }

    public function store(Request $request)
    {
        /** @var Model $articleModel */
        $articleModel = ArticleModel::find($request->input('id'));
        if (!$articleModel) {
            return '文档不存在';
        } else {
            if ($articleModel->content === $request->input('content')) {
                return '没有内容变更';
            } else {
                $articleModel->content = $request->input('content');
                if ($articleModel->save()) {
                    return '保存成功';
                } else {
                    return '保存失败';
                }
            }
        }
    }
}

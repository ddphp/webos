<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Models\Admin\Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;

class ImgManager extends Controller
{
    public function upload(Request $request)
    {
        /** @var UploadedFile $file */
        $file = $request->img;
        $sha1 = sha1_file($file->getFileInfo());
        /** @var Model $model */
        $model = Images::where('sha1', $sha1)->first();
        if (!$model) {
            $model = new Images();
            $model->file = $file->store('admin/images');
            $model->sha1 = $sha1;
            $model->ext  = $file->getClientOriginalExtension();
            $model->mime = $file->getMimeType();
            $model->save();
        }
        return route('admin.img.show', [$model->id]);
    }

    public function show($id)
    {
        $width = 480;
        $imgModel = Images::findOrFail($id);
        $img = \Image::make(storage_path('app/'.$imgModel->file));
        $img->resize($width, $width*$img->height()/$img->width());
        $response = \Response::make($img->encode($imgModel->ext));
        $response->header('Content-Type', $imgModel->mime);  // Content-Type:image/jpeg
//        $cache = 3600 * 24 * 365;
//        $response->header('Cache-Control', "max-age={$cache}");
//        $response->header('Last-Modified', gmdate('D, d M Y H:i:s', time()).' GMT');
        return $response;
    }
}

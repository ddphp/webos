<?php

namespace App\Http\Controllers\Voting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Images extends Controller
{
    public function handle($width, $stamp, $id, $ext)
    {
        $info = \App\Models\Voting\Images::findOrFail($id);
        if ($stamp == $info->updated_at->getTimestamp() && $ext === $info->ext) {
            $img = \Image::make(storage_path('app/'.$info->path.'/'.$info->name.'.'.$info->ext));

            $img->resize($width, $width*$img->height()/$img->width());

            $response = \Response::make($img->encode($info->ext));
            $response->header('Content-Type', $info->mime);  // Content-Type:image/jpeg
            $cache = 3600 * 24 * 365;
            $response->header('Cache-Control', "max-age={$cache}");
            $response->header('Last-Modified', gmdate('D, d M Y H:i:s', time()).' GMT');

            return $response;
        } else {
            die;
        }
    }
}

<?php

namespace App\Http\Controllers\Img;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Card extends Controller
{
    public function handle(Request $request, $type, $id)
    {
        $width = 280;
        if ($type == '07') {
            $color = '993300';
        } else {
            $color = 'ffffcc';
        }

        $img = \Image::make(public_path("static/images/wx/card{$type}.png"));

        $img->text(config('app.company.store'), 85, 560, function ($font) use ($color) {
            $font->file(public_path('static/font/mn.TTF'));
            $font->size(48);
            $font->color($color);
        });

        $img->text('NO.'.$id, 455, 575, function ($font) use ($color) {
            $font->file(public_path('static/font/OCR-B 10 BT.ttf'));
            $font->size(68);
            $font->color('#'.$color);
        });

        $img->resize($width, $width*$img->height()/$img->width());

        $response = \Response::make($img->encode('jpg'));
        $response->header('Content-Type', 'image/jpeg');  // Content-Type:image/jpeg
        $cache = 3600 * 24 * 365;
        $response->header('Cache-Control', "max-age={$cache}");
        $response->header('Last-Modified', gmdate('D, d M Y H:i:s', time()).' GMT');

        return $response;
    }
}

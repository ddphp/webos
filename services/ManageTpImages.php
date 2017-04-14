<?php
namespace Serv;

use App\Contracts\Voting\ManageImages;
use App\Models\Voting\Images;
use Illuminate\Http\UploadedFile;

class ManageTpImages implements ManageImages
{
    public function saveImage(UploadedFile $uploadedFile)
    {
        $md5 = md5_file($uploadedFile->path());
        $image = Images::where('md5', $md5)->first();
        if (!$image) {
            $pathInfo = pathinfo($uploadedFile->store('tp/images'));
            $image = app(Images::class);
            $image->md5 = $md5;
            $image->path = $pathInfo['dirname'];
            $image->name = $pathInfo['filename'];
            $image->ext = $pathInfo['extension'];
            $image->mime = $uploadedFile->getClientMimeType();
            $image->size = $uploadedFile->getClientSize();

            $image->save();
        }
        return $image;
    }

    public function getImageUrl($image, $width = 480)
    {
        $url = route('tp.images', [
            'width' => $width,
            'stamp' => $image->updated_at->getTimestamp(),
            'id' => $image->id,
            'ext' => $image->ext
        ]);

        return $url;
    }

}
<?php
namespace App\Contracts\Voting;

use App\Models\Voting\Images as VotingImagesModel;
use \Illuminate\Http\UploadedFile;

interface ManageImages
{
    /**
     * 保存图片
     * 如果图片已存在，则直接返回图片素材 ID,否则保存图片并返回素材 ID
     * @param UploadedFile $uploadedFile
     * @return VotingImagesModel
     */
    public function saveImage(UploadedFile $uploadedFile);

    /**
     * 获取图片 Url 地址
     * @param VotingImagesModel $image
     * @param int $width 图片素材宽度
     * @return string
     */
    public function getImageUrl($image, $width = 480);
}
<?php

namespace App\Services;


use JD\Cloudder\Facades\Cloudder;

class UploadCloudinary
{
    public function upload_image($image)
    {
        $image = $image->getRealPath();
        Cloudder::upload($image, null);
        list($width, $height) = getimagesize($image);
        $public_id = Cloudder::getPublicId();
        $image_url = Cloudder::show($public_id, ["width" => $width, "height" => $height]);

        return [
            'image_url' => $image_url,
            'public_id' => $public_id
        ];
    }

    public function destroy_image($public_id, $options = [])
    {
        return Cloudder::destroyImage($public_id, $options);
    }
}

<?php
namespace App\Util;

use File;
use Image;


class ImageHelper{

    public static function upload_path(){
        return base_path().'/public/userfiles/';
    }

    //Resize image within aspect ratio
    public static function resize($file, $save_as, $width, $height)
    {
        $array_path = explode('/', $save_as);
        $file_name  = end($array_path);
        $file_path  = self::upload_path().$save_as;

        $image = Image::make($file->getRealPath())
            ->resize(null, $width, function ($constraint) {
                $constraint->aspectRatio();
            })
        //->fill('#ffffff', 0, 0)
        ->fit($width, $height)
        ->save($file_path);

        return $image;
    }


}
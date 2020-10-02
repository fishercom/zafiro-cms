<?php
namespace App\Util;

class Embed{

    public static function youtube_url($url){

        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        if(count($matches)>0) $url='https://www.youtube.com/embed/'.$matches[0];

    	return $url;
    }
}

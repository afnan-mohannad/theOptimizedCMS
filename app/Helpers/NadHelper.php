<?php

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;

function embedMetas($page,$slug=null,$id=null){

    $site_name = setting('site.title');
    $image = setting('site.image');
    $keywords = str_replace(" ",",",setting('site.keywords'));

    switch ($page) {

        case "main":
            $title = setting('site.title');
            $description = setting('site.description');
            $keywords = str_replace(" ",",",setting('site.keywords'));
            $image = setting('site.image');
        break;
    }

    $title = fixString($title);
    $site_name = fixString($site_name);
    $description = fixString($description);

    $meta = [
        'site_name' => $site_name,
        'title' => \Illuminate\Support\Str::limit($title,60),
        'description' => $description,
        'keywords' => $keywords,
        'url' => URL::current(),
        'image' => $image,
    ];

    return $meta;
}

function fixString($text){
    $text = str_replace('"',"",$text);
    $text = str_replace("'","",$text);
    $text = htmlspecialchars($text);
    $text = str_replace("\n","",$text);
    $text = str_replace("\r","",$text);
    $text = str_replace("\n\r","",$text);
    $text = str_replace("\l","",$text);
    return ($text);
}

function getImage($path=null,$crop=null,$width=null,$height=null,$ratio=false){

    $fileInfo = pathinfo(storage_path().$path);

    if ($crop) {
        $cropName = $fileInfo['basename'];
    if(file_exists('storage/croped/'.$cropName))
            $image = 'storage/croped/'.$cropName;
    else $image = uploadCropImage($crop,$cropName);
    } elseif($path && file_exists('storage/'.$path)){
        $image = 'storage/'.$path;
    } else{
        $image = 'assets/frontend/images/main/media2.png';
        $fileInfo = pathinfo(storage_path().$image);
    }

    $ext = $fileInfo['extension'];
    if ($ratio) $thumbName = "ratio-" . $width."-".$height.$fileInfo['filename'].".".$ext;
    else $thumbName = $width."-".$height.$fileInfo['filename'].".".$ext;

    if(!isset($width) && !isset($height) && file_exists('storage/'.$path)) $thumb = 'storage/'.$path;
    else if(!isset($width) && !isset($height) && !file_exists('storage/'.$path)) $thumb = 'assets/frontend/images/main/media2.png';
    else $thumb = 'storage/thumbs/'.$thumbName;

    if((!file_exists($thumb))){
        $img = resizeImage($image,$width,$height,$ratio);
    } else $img = asset($thumb);

    return $img;
}

function uploadCropImage($blbImg,$name){

    $image = $blbImg;
    list($type, $image) = explode(';', $image);
    list(, $image)      = explode(',', $image);

    $image = base64_decode($image);
    $image_name= $name;
    $path = public_path('storage/croped/'.$image_name);

    file_put_contents($path, $image);
    return 'storage/croped/'.$image_name;
}

function resizeImage($path,$width=null,$height=null,$ratio=false){

    $image = $path;
    $fileInfo = pathinfo(storage_path().$path);
    $ext = $fileInfo['extension'];

    if (strpos($path, 'img.youtube') !== false) {
        $getvdid = explode('/',$path);
        $filename = $getvdid[4].$fileInfo['filename'];
    } else  $filename = $fileInfo['filename'];

    if ($ratio) $thumb = "ratio-" . $width."-".$height.$filename.".".$ext;
    else $thumb = $width."-".$height.$filename.".".$ext;

    $destinationPath = public_path('storage/thumbs');

    if (!file_exists($destinationPath)) {

        mkdir($destinationPath, 0755, true);
    }

    $img = Image::make($image);

    $img->fit($width, $height)->save($destinationPath.'/'.$thumb);

    return asset('/storage/thumbs/'.$thumb);
}

function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null){
    $name = !is_null($filename) ? $filename : str_random(25);

    $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

    return $file;
}

function getVidImage($path=null,$crop=null,$width=null,$height=null,$ratio=false){

    if (strpos($path, 'graph.facebook') !== false) {
        return ($path);
    } else {
        $fileInfo = pathinfo(storage_path().$path);

        if ($crop) {
            $cropName = $fileInfo['basename'];
            if(file_exists('storage/croped/'.$cropName))
                $image = 'storage/croped/'.$cropName;
            else $image = uploadCropImage($crop,$cropName);
        } elseif(filter_var($path, FILTER_VALIDATE_URL)){
            $image = $path;
        } elseif($path && file_exists('storage/'.$path)){
            $image = 'storage/'.$path;
        } else{
            $image = 'assets/frontend/images/main/media2.png';
            $fileInfo = pathinfo(storage_path().$image);
        }

        $ext = $fileInfo['extension'];
        if (strpos($path, 'img.youtube') !== false) {
            $getvdid = explode('/',$path);
            $filename = $getvdid[4].$fileInfo['filename'];
        } else  $filename = $fileInfo['filename'];

        if ($ratio) $thumbName = "ratio-" . $width."-".$height.$filename.".".$ext;
        else $thumbName = $width."-".$height.$filename.".".$ext;


        if(!isset($width) && !isset($height)) $thumb = 'storage/'.$path;

        else $thumb = 'storage/thumbs/'.$thumbName;


        if((!file_exists($thumb))){

            $img = resizeImage($image,$width,$height,$ratio);
        } else $img = asset($thumb);

        return $img;

    }
}

function replace_between($str, $needle_start, $needle_end, $replacement){
    $pos = strpos($str, $needle_start);
    $start = $pos === false ? 0 : $pos + strlen($needle_start);

    $pos = strpos($str, $needle_end, $start);
    $end = $pos === false ? strlen($str) : $pos;

    return substr_replace($str, $replacement, $start, $end - $start);
}

function addNofollowTag($html, $skip = null){
    return preg_replace_callback(
        "#(<a[^>]+?)>#is", function ($mach) use ($skip) {
        return (
            !($skip && strpos($mach[1], $skip) !== false) &&
            strpos($mach[1], 'rel=') === false
            ) ? $mach[1] . 'rel="nofollow">' : $mach[0];
        },
        $html
        );
}

function seoHrefNofollow($content){
    $qui = parse_url("https://".$_SERVER['HTTP_HOST']);
    return addNofollowTag( $content, $qui['host'] );
}

function slug($string, $separator = '-') {
    if (is_null($string)) {
        return "";
    }

    $string = trim($string);

    $string = mb_strtolower($string, "UTF-8");;

    $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

    $string = preg_replace("/[\s-]+/", " ", $string);

    $string = preg_replace("/[\s_]/", $separator, $string);

    return $string;
}

function lang(){
    return (app()->getLocale()) ? app()->getLocale() : "he";
}

function ip(){
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    }else if($_SERVER['REMOTE_ADDR']){
        $ip = explode(',', $_SERVER['REMOTE_ADDR'])[0];
    }
    return $ip;
}
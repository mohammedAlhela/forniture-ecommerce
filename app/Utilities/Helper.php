<?php
namespace App\Utilities;
use Image;
class Helper
{
    public static function uploadImage($data)
    {
        if ($data["image"]) {
            // delete old image
            if ($data["record"]->image && $data["record"]->image != $data["imagePath"] && file_exists(public_path() . $data["record"]->image)) {
                unlink(substr($data["record"]->image, 1));
            }
            // delete old image
    
            $imageName = time() . '.webp';
            Image::make($data["image"])->fit($data["width"] , $data["height"])->save(public_path($data["dirPath"]) . $imageName);
            $data["record"]->image = $data["dirPath"] . $imageName;
        }
    
        $data["record"]->save();
    }


}
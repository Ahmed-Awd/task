<?php


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


function imageStore($file, $resize = true): string
{
    $image = $file;
    $img = Image::make($image->getRealPath());
    if ($resize == true) {
        $img->resize(360, 360, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
    $img->stream();
    $name = date("Y/m/d") . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
    Storage::disk('public')->put($name, $img, 'public');
    return $name;
}

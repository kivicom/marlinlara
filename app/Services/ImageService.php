<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function one($id)
    {
        $image = DB::table('users')
            ->select('image')->where('id',$id)->first();

        return $image;
    }

    public function update($id, $newImage){
        $image = DB::table('users')->select('image')->where('id',$id)->first();
        Storage::delete($image->image);
        if($newImage != null){
            $newImage = $newImage->store('cabinet/user_' . $id);
        }

        DB::table('users')->where('id', $id)->update(['image' => $newImage]);

        return $newImage;
    }

    public function delete($id)
    {
        $image = $this->one($id);
        Storage::delete($image->image);

        DB::table('images')->where('id', $id)->delete();
    }
}
<?php
namespace App\Traits;

use Image;
use Illuminate\Support\Facades\File;

trait GeneralTrait
{
    // public function upload_video($url) {
    //    $value = time(). '.'.$url->getClientOriginalExtension();
    // // $name =  $url->store("","google");
    //    \Storage::disk('google')->putFileAs("",$url,$value);
    //    return $value;
    // } 
    public function delete_video($video) {

        //if($video->storage_type == 0){

        if(public_path() . '/uploads/' . $video->url){

            $link1 = public_path() . '/uploads/' . $video->url;
                File::delete($link1);
        }
        //     }
        // } else if($video->storage_type == 1){


        // }
           
       }
  
} 

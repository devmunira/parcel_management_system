<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\BanglaDate;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

function makeDirectory($path){
    if(file_exists($path)){
        return true;
    }else{
       return mkdir($path, 0755 , true);
    }
}

function unlinkFile($path){
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function uploadSingleImg($file,$location,$old = null,$size=null,$radio = 70){

    $path = makeDirectory($location);
    if(!$path) throw new Exception('File counld not be Created');
    $filename = '';

    if(empty($file) || $file == NULL){
       $filename =  $old;
    }else if(!empty($file) || $file != NULL){
        if(!empty($old) || $old != NULL){
            unlinkFile($location . '/' . $old);
        }
        $filename = md5(time().rand().uniqid()) .'.'. $file -> getClientOriginalExtension();
        $image = Image::make($file);

        if(!empty($size)){
            $array = explode('x', strtolower($size));
            $width = $array[0];
            $height = $array[1];

            $canvas = Image::canvas($width, $height);

            $image = $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $canvas->insert($image, 'center');
            $canvas->save($location . '/' . $filename , $radio);
        }else{
            $image->save($location . '/' . $filename , $radio);
        }
    }


    return $filename;

}



function multiImageUpload($files,$location,$old = null,$size=null, $radio = 50){
    $path = makeDirectory($location);
    if(!$path) throw new Exception('File could not be created');

    $images = [];
    if(!empty($old) || $old != NULL){
        if(empty($files) || $files == NULL){
            $images =  $old;
        }
    }

   if(!empty($files) || $files != NULL){
        if($old){
            foreach($old as $old){
                unlinkFile($location . '/' . $old);
            }
        }
        foreach($files as $file){

                $filename = time().uniqid() .'.'. $file -> getClientOriginalExtension();
                $image = Image::make($file);

                if(!empty($size)){
                    $array = explode('x',strtolower($size));
                    $width = $array[0];
                    $height = $array[1];

                    $canvas = Image::canvas($width, $height);

                    $image = $image->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $canvas->insert($image, 'center');
                    $canvas->save($location . '/' . $filename , $radio);

                }else{
                    $image->save($location . '/' . $filename , $radio);
                }

                array_push($images,$filename);


        }
    }




    return $images;

}

function uploadAudio($audio , $location,$old){
    if(!empty($old) || $old != NULL){
        unlinkFile($location . '/' . $old);
    }

     $uniqueid=uniqid();
     $extension=$audio->getClientOriginalExtension();
     $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
     $audio->move( $location , $filename);
     return $filename;

}


function activeMenuMain($route){
    $class = 'active pcoded-trigger';

    if(is_array($route)){
        foreach($route as $route){
            if(request()->routeIs($route)){
                return $class;
            }
        }
    }elseif(request()->routeIs($route)){
        return $class;
    }

}

function activeMenu($route){
    $class = 'active';

    if(is_array($route)){
        foreach($route as $route){
            if(request()->routeIs($route)){
                return $class;
            }
        }
    }elseif(request()->routeIs($route)){
        return $class;
    }

}


function slug($str){
    return strtolower(str_replace(' ' , '-' , $str));
}

function verificationCode($length)
{
    if ($length == 0) return 0;

    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}

function phpMailer($data,$general){
    $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $general->email_method['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $general->email_method['user_name'];
            $mail->Password   = $general->email_method['password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $general->email_method['smtp_port'];
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($general->site_email, $general->site_title);
            $mail->addAddress($data['email'], $data['name']);
            $mail->addReplyTo($general->site_email, $general->site_title);
            $mail->isHTML(true);
            $mail->Subject = $data['subject'];
            $mail->Body    = $data['message'];
            $mail->send();
        } catch (Exception $e) {
            throw new Exception($e);
        }

}



function getCatPosts($id){
    $category = Category::with('posts')->findOrFail($id);
    return $category->posts->where('status' , 'Published');
}


function delete($id , $model , $photo='' , $path=''){
   $delete_data =  $model::find($id);
   if($delete_data){
        if($delete_data -> photo){
            unlinkFile($path , $photo);
        }
        $delete_data -> delete();
   }else{
       return false;
   }
}

?>

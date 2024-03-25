<?php
use App\Models\Notification;
use App\Models\Language;

if (!function_exists('getListNotification')) {
    function getListNotification(){
        return Notification::orderBy('id', 'DESC')->limit(15)->get();
    }
} 

if (!function_exists('getListLanguage')) {
    function getListLanguage($status){
        return Language::where('status', $status)->first();
    }
}   

function checkSpaceCKEditor($string)
{
    $bool = false;
    $string = explode(" ",$string);
    foreach($string as $item) {
        if(!in_array( $item ,['&nbsp;', '&nbsp;&nbsp;', ""])) {
            $bool = true;
            break;
        }
    }
    return $bool;
}
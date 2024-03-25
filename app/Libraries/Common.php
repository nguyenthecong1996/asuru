<?php
namespace App\Libraries;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Jobs\SendCancelReservationJob;

class Common
{
    public static function pushCancelReservation($token , $message, $title)
    {
        $options = [
            'token' => $token,
            'message' => $message,
            'title' =>  $title,
            'data' => [],
        ];
        dispatch(new SendCancelReservationJob($options));
    }

    public static function clearXSS($string)
    {
        $string = nl2br($string);
        $string = trim(strip_tags($string));
        $string = self::removeScripts($string);
        return $string;
    }

    public static function cleanData($str)
    {
        $str = strip_tags($str);
        $str = html_entity_decode($str);
        // $str = str_replace("&nbsp;", " ", $str);
        $str = preg_replace("/\s+/", " ", $str);
        $str = trim($str);
        return $str;
    }

    public static function removeScripts($str)
    {
        $regex =
            '/(<link[^>]+rel="[^"]*stylesheet"[^>]*>)|' .
            '<script[^>]*>.*?<\/script>|' .
            '<style[^>]*>.*?<\/style>|' .
            '<!--.*?-->/is';

        return preg_replace($regex, '', $str);
    }

    public static function generateVerifyCode()
    {
        return mt_rand(100000, 999999);
        // return 111111;
    }

    /**
         * Clear data input.
         *
         * @return array
         */
    public static function clearArray($array)
        {
            $data = [];
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = self::clearArray($value);
                } else {
                    $data[$key] = self::clearXSS($value);
                }
            }
    
        return $data;
    }

    public static function uploadLibrary($image)
    {
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $storage = 'public/';
        $image->storeAs($storage, $imageName);
        return $imageName;
    }

    public static function updateAllData($arr)
    {
        $data = [];
        foreach($arr as $key => $item) {
            if(file_exists($item)) {
                $data[$key] = self::uploadLibrary($item);
                continue;
            }
            $data[$key] = self::clearXSS($item);
        }
        return $data;
    }

    public static function calculatorCardRank($total)
    {
        switch ($total) {
            case $total >= 0 && $total <= 99999:
                return 0;
                break;
            case $total >= 100000 && $total <= 299999:
                return 1;
                break;
            case $total >= 300000 && $total <= 999999:
                return 2;
                break;
            case $total >= 1000000 && $total <= 4999999:
                return 3;
                break;
            case $total >= 5000000 && $total <= 9999999:
                return 4;
                break;            
            default:
                return 5;
                break;
        }
    }

    public static function calculatorPoint($total)
    {
        $point = floor($total/1000);
        return $point;
    }

}
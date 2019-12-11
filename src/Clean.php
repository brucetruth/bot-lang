<?php
/**
 * Created by Bruce Mubangwa on Dec, 2019
 */
namespace BotLang;
class Clean
{

    private static $text = '';

    public static function pre($text=''){
        self::$text = $text ?? self::$text;
        $response = preg_replace('/\+/','<plus>',self::$text);
        $response = preg_replace('/\t/',' ',$response);
        $response = preg_replace('/\n/',' ',$response);
        $response = preg_replace('/\s+/',' ',$response);
        $response = preg_replace('/(’|‘)/','\'',$response);
        $response = preg_replace('/(“|”)/','"',$response);
        $response = preg_replace('/(–|—)/','—',$response);
     //   $response = preg_replace('/[\u00A1-\u1EF3]/',' ',$response);


        return $response;
    }


    public static function post($text=''){
        self::$text = $text ?? self::$text;
        $response = preg_replace('/[+]{1}/',' ',self::$text);
        $response = preg_replace('/<plus>/','+',$response);
       // if(preg_match('/[0-9]+[,]+[0-9]+/',$response)){
        //    $response = str_replace(',','',$response);
        //}


        $response = preg_replace_callback('/(?P<nrs>[0-9]+,[0-9]+)/',array(new Clean(),"cleanComma"),$response);

        return $response;
    }

    function cleanComma($matches){
        return str_replace(',','', $matches['nrs']);
    }

    public static function all($text=''){
        self::$text = $text ?? self::$text;
        return trim(self::post(self::pre($text)));
    }




}
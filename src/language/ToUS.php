<?php
/**
 * Created by Bruce Mubangwa on Dec, 2019
 */

namespace BotLang\language;


use BotLang\Clean;
use BotLang\Util;

class ToUS
{
    private static $replacements = [];





    public static function process($input) {
        $model = 'replace/british.txt';

        $replacements = self::$replacements ?? [];

        $slitString = explode(' ',$input);


        $handle = fopen(Util::$datapath.$model, 'r');
        if ($handle) {

            while (($line = fgets($handle)) !== false) {

                $line = explode(' ', $line);
                $line[1] = Clean::all($line[1]);
                if(!isset($replacements[$line[0]])) {
                    $replacements[$line[0]] = $line[1];
                }
            }

            fclose($handle);

            foreach ($slitString as $phase){
                if(isset($replacements[$phase])){
                    $input = str_replace($phase, $replacements[$phase],$input);
                }
            }


        } else {
            // error opening the file.
        }


        return Clean::all($input);
    }
}
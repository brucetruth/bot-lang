<?php
/**
 * Created by Bruce Mubangwa on Dec, 2019
 */

namespace BotLang\language;


use BotLang\Clean;
use BotLang\Util;

class Contractions
{


    public static function process($input) {
        $model = 'replace/contractions.txt';

        $replacements = self::$replacements ?? [];

        $slitString = explode(' ',$input);


        $handle = fopen(Util::$datapath.$model, 'r');
        if ($handle) {

            while (($line = fgets($handle)) !== false) {

                $line = explode(' ', $line);
                $line[0] = Clean::all($line[0]);
                if(!isset($replacements[$line[0]])) {
                    $replacements[$line[0]] = $line[1];
                }
            }

            fclose($handle);
             print_r($replacements);
            foreach ($slitString as $phase){
                if(isset($replacements[$phase])){
                    $placement = str_replace('+',' ', $replacements[$phase]);
                    $input = str_replace($phase, $placement,$input);
                }
            }


        } else {
            // error opening the file.
        }


        return Clean::all($input);
    }

}
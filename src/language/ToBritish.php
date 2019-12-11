<?php
/**
 * Created by Bruce Mubangwa on Dec, 2019
 */

namespace BotLang\language;


use BotLang\Clean;
use BotLang\Util;

class ToBritish
{
    private static $replacements = [];





    public static function process($input) {
        $model = 'replace/british.txt';

       // $input = Clean::all($input);
        $replacements = [];

        $slitString = explode(' ',$input);


        $handle = fopen(Util::$datapath.$model, 'r');
        if ($handle) {

            while (($line = fgets($handle)) !== false) {

                $line = explode(' ', $line);
                $line[1] = Clean::all($line[1]);
                if(!isset($replacements[$line[1]])) {

                    $replacements[$line[1]] = $line[0];
                }
            }

            fclose($handle);


            foreach ($slitString as $phase){

                if(isset($replacements[$phase])){
                    echo $replacements[$phase]."\n";
                    $input = str_replace($phase, $replacements[$phase],$input);
                }
            }


        } else {
            // error opening the file.
        }


        return Clean::all($input);
    }
}
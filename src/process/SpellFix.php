<?php
/**
 * Created by Bruce Mubangwa on Dec, 2019
 */

namespace BotLang\process;


use BotLang\Clean;
use BotLang\Util;

class SpellFix
{

    private static $replacements = [];


     private function testRegexpArray($msg){

         $slitString = explode(' ',$msg);


     }


    public static function spellfix($input) {
        $model = 'replace/spellfix.txt';

        $input = Clean::all($input);
        $replacements = self::$replacements ?? [];

        $slitString = explode(' ',$input);


        $handle = fopen(Util::$datapath.$model, 'r');
        if ($handle) {

            while (($line = fgets($handle)) !== false) {

                $line = explode(' ', $line);
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
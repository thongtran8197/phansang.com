<?php


namespace App\Services;


use Stichoza\GoogleTranslate\GoogleTranslate;

class Translate
{
    public function gg_translate($from_language, $to_language, $text)
    {
        $res = "";
        if ($text != "") {
            $tr_en = new GoogleTranslate();
            $res =  $tr_en->setSource($from_language)->setTarget($to_language)->translate($text);
        }
        return $res;
    }
}

<?php

namespace App\Utils;

use function Safe\preg_replace;
use Nette\Utils\Strings;

class Slugger
{
    /**
     * @param string $string
     * @param string $separator
     *
     * @return string
     */
    public function slugify(string $string = '', string $separator = '-'): string
    {
        $slug = trim(strip_tags($string));
        $slug = Slugger::transliterate($slug);
        $slug = Strings::replace($slug, "/[^a-zA-Z0-9\/_|+ -]/", '');
        $slug = Strings::replace($slug, "/[\/_|+ -]+/", $separator);
        $slug = strtolower($slug);
        $slug = trim($slug, $separator);
        
        return $slug;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function transliterate(string $string): string
    {
        $characterMap = array(
            // Latin
            'À' => 'A', 'Á' => 'A',  'Â' => 'A',  'Ã' => 'A', 'Ä' => 'A',
            'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',  'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E',  'Ì' => 'I',  'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ð' => 'D',  'Ñ' => 'N',  'Ò' => 'O', 'Ó' => 'O',
            'Ô' => 'O', 'Õ' => 'O',  'Ö' => 'O',  'Ő' => 'O', 'Ø' => 'O',
            'Ù' => 'U', 'Ú' => 'U',  'Û' => 'U',  'Ü' => 'U', 'Ű' => 'U',
            'Ũ' => 'U', 'Ý' => 'Y',  'Þ' => 'TH', 'ß' => 'ss',
            'à' => 'a', 'á' => 'a',  'â' => 'a',  'ã' => 'a',  'ä' => 'a',
            'å' => 'a', 'æ' => 'ae', 'ç' => 'c',  'è' => 'e',  'é' => 'e',
            'ê' => 'e', 'ë' => 'e',  'ì' => 'i',  'í' => 'i',  'î' => 'i',
            'ï' => 'i', 'ð' => 'd',  'ñ' => 'n',  'ò' => 'o',  'ó' => 'o',
            'ô' => 'o', 'õ' => 'o',  'ö' => 'o',  'ő' => 'o',  'ø' => 'o',
            'ù' => 'u', 'ú' => 'u',  'û' => 'u',  'ü' => 'u',  'ű' => 'u',
            'ũ' => 'u', 'ý' => 'y',  'þ' => 'th', 'ÿ' => 'y',
        );
        return str_replace(array_keys($characterMap), $characterMap, $string);
    }
}

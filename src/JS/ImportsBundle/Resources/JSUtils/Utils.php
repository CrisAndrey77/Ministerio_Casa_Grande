<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace JS\ImportsBundle\Resources\JSUtils;

/**
 * Description of Utils
 *
 * @author leonardo
 */
class Utils
{
    public static function gethashtags($text)
    {
        //Match the hashtags
        preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
        $hashtag = '';
        // For each hashtag, strip all characters but alpha numeric
        if (!empty($matchedHashtags[0]))
        {
            foreach ($matchedHashtags[0] as $match)
            {
                $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match) . ',';
            }
        }
        //to remove last comma in a string
        return rtrim($hashtag, ',');
    }
    
    public static function slugify($string)
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }
    
    /**
     * Metodo para generar un password aleatorio
     * @param <INT> $len - Largo de el password
     * @return <STRING>
     */
    static function generatePassword($len = 8)
    {
        $r = '';
        for ($i = 0; $i < $len; $i++)
            $r .= chr(rand(0, 25) + ord('a'));
        return $r;
    }
    
    public static function humanCountry($country_code)
    {
        $c = \Symfony\Component\Locale\Locale::getDisplayCountries('en');

        return array_key_exists($country_code, $c) ? $c[$country_code] : $country_code;
    }

    public static function addhttp($url) 
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) 
        {
            $url = "http://" . $url;
        }
        
        return $url;
    }

}

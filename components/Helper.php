<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Universal helper for common use cases
 * @package app\components
 */
class Helper
{
    public static $ourAgeTs = -62135605817;

    public static function createSlug($source)
    {
        $source = trim(mb_strtolower($source));
        $translateArray = [
            "ый" => "y", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "",
            "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "-", "." => "", "/" => "-", "_" => "-"
        ];
        $source = preg_replace('#[^a-z0-9\-]#is', '', strtr($source, $translateArray));
        return trim(preg_replace('#-{2,}#is', '-', $source));
    }
    public static function strtotime(string $date, bool $ourEra = true,bool $right = FALSE) {
        $date = self::dateToNormalStr($date,$right);
        if($ourEra)
            return strtotime($date);
        else {
            $strtotimeDate = strtotime($date);
            $strtotimeDate = 2*self::$ourAgeTs-$strtotimeDate;
            return $strtotimeDate;
        }
    }
    public static function date(string $format,int $timestamp = NULL,bool $retString = true) {
        if(is_null($timestamp) || $timestamp >= self::$ourAgeTs)
            $date =  [
                'date' => date($format,$timestamp),
                'age' => 1
            ];
        else {
            $date = [
                'date' => date($format,(2*self::$ourAgeTs-$timestamp)),
                'age' => 0
            ];
        }
        if($retString) {
            return $date['date'].' '.($date['age'] > 0?Yii::t('app','AD'):Yii::t('app','BC'));
        }
        else return $date;
    }
    public static function gmdate(string $format,int $timestamp = NULL,bool $retString = true) {
        if(is_null($timestamp) || $timestamp >= self::$ourAgeTs)
            $date =  [
                'date' => gmdate($format,$timestamp),
                'age' => 1
            ];
        else {
            $date = [
                'date' => gmdate($format,(2*self::$ourAgeTs-$timestamp)),
                'age' => 0
            ];
        }
        if($retString) {
            return $date['date'].' '.($date['age'] > 0?Yii::t('app','AD'):Yii::t('app','BC'));
        }
        else return $date;
    }
    public static function addZero(string $datePar,int $length = 2)
    {
        $diff = $length-strlen($datePar);
        if($diff > 0) {
            for($i = 0; $i<$diff; $i++)
                $datePar = "0".$datePar;
        }
        return $datePar;
    }
    public static function dateToNormalStr(string $date, bool $right = FALSE)
    {
        $formating = explode('.',$date);
        if(count($formating) <= 3) {
            $dayDef = "01";
            $monthDef = "01";
            if($right) {
                $dayDef = "31";
                $monthDef = "12";
            }
            $day = count($formating) == 3?self::addZero((string)(int)$formating[0],2):$dayDef;
            $month = count($formating) >= 2?self::addZero((string)(int)$formating[1],2):$monthDef;
            if(count($formating) == 3)
                $year = (int)$formating[2];
            elseif(count($formating) == 2)
                $year = (int)$formating[1];
            else
                $year = (int)$formating[0];
            if($year < 0) $year *=(-1);
            $year = self::addZero((string)$year,4);
            if(!$right)
                $year = "00:00:00 ".$day.".".$month.".".$year." UTC";
            else
                $year = "23:59:59 ".$day.".".$month.".".$year." UTC";
            return $year;
        }
        elseif(!$right)
            return "00:00:00 01.01.0001 UTC";
        else
            return "23:59:59 31.12.0001 UTC";
    }
    public static function removeOddSpace(string $string)
    {
        return preg_replace("/\s{2,}/",' ',$string);
    }
    public static function tagNormalize(string $tag)
    {
        return self::removeOddSpace(trim(mb_strtolower($tag)));
    }
}

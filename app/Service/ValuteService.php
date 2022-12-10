<?php

namespace App\Service;

use App\Models\Currency;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ValuteService
{
    static public $headUrl = "https://www.cbr.ru/scripts/XML_daily.asp?";

    public function find($value, $date_from = null, $date_to = null)
    {
        $query = Currency::where('valuteID', $value);
        if ($date_from !== null) {
            $date_from = self::converIntToString($date_from);
            $query->where('date', '>=', $date_from);
        }
        if ($date_to !== null) {
            $date_to = self::converIntToString($date_to);
            $query->where('date', '<=', $date_to);
        }
        return $query->get();
    }

    static function getQuotesDay($date = null)
    {
        $client = new Client();
        $url = self::$headUrl . "?date_req={$date}";
        $response = $client->get($url);
        return simplexml_load_string($response->getBody()->getContents());
    }

    static public function converIntToString($date)
    {
        $dates = explode('/', $date);
        return Carbon::create($dates[2], $dates[1], $dates[0]);
    }

    static public function echoXmlConvert($xml)
    {
        foreach ($xml->Valute as $a) {
            echo($a->attributes()->ID);
            echo "</br>";
            echo($a->NumCode);
            echo "</br>";
            echo($a->CharCode);
            echo "</br>";
            echo($a->Nominal);
            echo "</br>";
            echo($a->Name);
            echo "</br>";
            echo($a->Value);
            echo "</br>";
            echo "</br>";
        }
    }

}

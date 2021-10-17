<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class ExchangeRates
{
//    private string $name;
//
//    public function __clone()
//    {
//        $this->name = 'Maksym';
//    }
//
//    public function __call($name, $arguments)
//    {
//        if ($name == 'setName') {
//            $this->name = $arguments[0];
//        }
//
//        if ($name == 'getName') {
//            return $this->name;
//        }
//    }

    public function rates()
    {
        $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');

        return $response->json();
    }

//    public function __set($name, $value)
//    {
//        $this->otherData[$name] = $value;
//    }
//
////    public function __get($name)
////    {
////        return $this->otherData[$name];
////    }
//
//    public function __toString(): string
//    {
//        return 'Hello';
//    }
}

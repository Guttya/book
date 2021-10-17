<?php

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;

class WeatherParser
{
    public function parse(): array
    {
        $crawler = new Crawler(file_get_contents('https://sinoptik.ua/%D0%BF%D0%BE%D0%B3%D0%BE%D0%B4%D0%B0-%D0%B4%D0%BD%D0%B5%D0%BF%D1%80-303007131'));

        $data = [];

        $crawler->filter('#blockDays > .tabs')->children('.main')->each(function (Crawler $node, $i) use (&$data) {
            $data[$node->filter('.main > p.date')->text()] = [
               'day_name' => $node->filter('.day-link')->text(),
               'day_number' => $node->filter('.main > p.date')->text(),
               'month' => $node->filter('.month')->text(),
               'weatherIco' => [
                   'ico' => $node->filter('.weatherIco > img')->attr('src'),
                   'title' => $node->filter('.weatherIco')->attr('title'),
               ],
               'temperature' => [
                   'min' => $node->filter('.temperature > .min')->text(),
                   'max' => $node->filter('.temperature > .max')->text(),
               ],
            ];
        });

        return $data;
    }
}


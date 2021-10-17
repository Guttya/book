<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\ExchangeRates;
use App\Service\WeatherParser;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Cache;

use Psr\SimpleCache\InvalidArgumentException;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param WeatherParser $parser
     * @param ExchangeRates $rates
     * @return Renderable
     * @throws InvalidArgumentException
     */
    public function index(WeatherParser $parser, ExchangeRates $rates): Renderable
    {
        $rates2 = $rates;

//        dd($rates2, $rates);

        $exchange = $rates->rates();

        $admin = User::all();

        if (Cache::store('file')->has('weather')) {
            $weather = Cache::store('file')->get('weather');
        } else {
            $weather = $parser->parse();
            Cache::store('file')->put('weather', $weather, 3600);
        }

        return view('home', [
            'admin' => $admin,
            'parsers' => $weather,
            'exchanges' => $exchange,
        ]);
    }
}

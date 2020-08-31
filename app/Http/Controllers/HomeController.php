<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Affichage de la page d'accueil.
     *
     * Récupère et envoie à la vue home les données du top 5 dans un tableau $dataTop5 et récupère sa valeur face à
     * l'euro pour les 365 dernier jours dans un tableau $dataCoins.
     * Récupère et envoie à la vue home les données du top 30 dans un tableau $dataTop et récupère sa valeur face à
     * l'euro pour les 24 dernieres heures.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        Top 5
        $dataTop5 = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&category=crypto&order=market_cap_desc&per_page=5&page=1&sparkline=false&price_change_percentage=24d')->json();
        $dataTopId = [];
        foreach ($dataTop5 as $value){
            array_push($dataTopId,$value['id']);
        }
        $dataCoins = [];
        foreach ($dataTopId as $value) {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/' . $value . '/market_chart?vs_currency=eur&days=365')->json();
            $dataCoins[$value] = [];
            array_push($dataCoins[$value],$response);
        }
//        Top 30
        $dataTop = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&category=crypto&order=market_cap_desc&per_page=30&page=1&sparkline=false&price_change_percentage=24d')->json();

        return view('home/home', [
            'datas' => $dataCoins,
            'datasTop30' => $dataTop
        ]);
    }
}

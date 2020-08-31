<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CoinsController extends Controller
{
    public function index($id)
    {
        $arrayCurrentPrice = [];
        $arrayDate = [];
        for ($i = 1; $i < 10; $i++) {
            $date = date('d-m-Y', strtotime('-' . $i . ' day'));
            $dateresponse = 'https://api.coingecko.com/api/v3/coins/' . $id . '/history?date=' . date('d-m-Y', strtotime('-' . $i . ' day')) . '';
//            dd($dateresponse);
            $data = Http::get($dateresponse)->json();
            $euro = $data['market_data']['current_price']['eur'];
            array_push($arrayDate, $date);
            array_push($arrayCurrentPrice, $euro);
        }
        $arrayCurrentPrice = array_reverse($arrayCurrentPrice);
        $arrayDate = array_reverse($arrayDate);


        //        Top 30
        $dataTop = Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&category=crypto&order=market_cap_desc&per_page=30&page=1&sparkline=false&price_change_percentage=24d')->json();


        return view('coins/coins', [
            'databitcoin' => $arrayCurrentPrice,
            'dateList' => $arrayDate,
            'datasTop30' => $dataTop,
            'id' => $id

        ]);
    }
}

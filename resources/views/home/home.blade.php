@extends('layout/base')

@section('content')

    <div class="header_container">
        <div class="column_container">
            <div class="column">
                <h1>ACHETEZ VOS CRYPTOS
                    DIFFEREMENT</h1>
                <br>
                <div>
                    La blockchain et les crypto-monnaies se veulent décentralisées
                    et accessibles à tous. Cela commence par la plateforme d'achat.
                </div>
            </div>
            <div class="column">

                <div class="module" data-component="conversion">
                    <div class="source">
                        <input class="amount" placeholder="Montant en euros..." maxlength="10">
                        <div class="currencyBlock">
                            {{--                            <img src="https://www.deskoin.com/images/icons/EUR.svg" alt="source">--}}
                            <span class="currency">EUR</span>
                        </div>
                    </div>
                    <div class="change">
                        <div class="picto">
                            <div class="e1"></div>
                            <div class="e2"></div>
                            <div class="e1"></div>
                        </div>
                        <div>
                            Pour <strong class="EURAmount">100 EUR</strong> vous recevez <strong class="BTCAmount">0.0103
                                BTC</strong>
                        </div>
                    </div>
                    <div class="destination">
                        <input class="amount" placeholder="Montant en bitcoin..." maxlength="10">
                        <div class="currencyBlock">
                            {{--                            <img src="https://www.deskoin.com/images/icons/BTC.svg" alt="destination">--}}
                            <span class="currency">BTC</span>
                        </div>
                    </div>
                    <a href="https://www.deskoin.com/login" class="buy">Acheter</a>
                </div>
            </div>
        </div>
    </div>
    <div id="container_charts">
        <div class="graph">
            <canvas class="graph" id="myChart" style="width: 90%!important;"></canvas>
        </div>
    </div>
@stop

@section('script')
    <script>
        @foreach($datas as $id => $data)
        <?php
        $dateArray = [];
        $priceArray = [];
        ?>
        @foreach($datas[$id][0]['prices'] as $price)
        <?php
        $date = date('d-m-Y', substr($price[0], 0, -3));
        array_push($dateArray, $date);
        array_push($priceArray, $price[1]);
        ?>
        @endforeach

        var data{{$id}} = <?php echo json_encode($dateArray ?? ''); ?>;
        var price{{$id}} = <?php echo json_encode($priceArray ?? ''); ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data{{$id}},
                datasets: [
                        @foreach($datas as $id => $data)
                    {
                        label: '<?= $id?>',
                        data: price{{$id}},
                        backgroundColor: [
                            'rgba(<?= rand(1, 255) ?>, <?= rand(1, 255) ?>, <?= rand(1, 255) ?>, 0.5)'
                        ],
                    },
                    @endforeach
                ]
            },
            options: {
                elements: {
                    point: {
                        radius: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });
        @endforeach
    </script>
@stop

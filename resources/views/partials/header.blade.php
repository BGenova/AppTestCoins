<div class="nav">
    <input type="checkbox" id="nav-check">
    <div class="nav-header">
        <div class="nav-title">
            <a href="" class="logo"><img src="../img/deskoin-white.png" alt=""> </a>
        </div>
    </div>
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="nav-links">
        <div class="menu">
            <a href="//github.io/jo_geek" target="_blank">Solutions</a>
            <a href="http://stackoverflow.com/users/4084003/" target="_blank">A propos</a>
            <a href="https://in.linkedin.com/in/jonesvinothjoseph" target="_blank">Connexion</a>
            <a href="https://codepen.io/jo_Geek/" target="_blank">Inscription</a>
        </div>

        <div class="card_container" style="display: flex;flex-wrap: wrap">
            @foreach($datasTop30 as $data)
                <a href="/coins/{{$data['id']}}" class="card">
                    <img class="card_img" src="{{$data['image']}}" alt="Card image cap">
                    <div class="card_body">
                        <h5 class="card_title">{{$data['name']}} </h5>
                        <span class="card_text">{{ round(floatval($data['current_price']),4) }} € </span>
                        @if(floatval($data['price_change_percentage_24h']) < 0)
                        <span class="red">{{ round(floatval($data['price_change_percentage_24h']),3) }}</span>
                        @else
                            <span class="green">{{ round(floatval($data['price_change_percentage_24h']),3) }}</span>
                        @endif
                        @if(floatval($data['ath_change_percentage']) < 0)
                            <span class="red">{{ round(floatval($data['ath_change_percentage']),3) }}%</span>
                        @else
                            <span class="green">{{ round(floatval($data['ath_change_percentage']),3) }}%</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>

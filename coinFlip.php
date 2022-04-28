<?php
include("connection.php");
include("functions.php");
 include("coinFlipping.php");

?>


<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <meta http-equiv="X-UA_Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <meta http-equiv="X-UA_Compatible" content="ie=edge">
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

    <link rel="stylesheet" href="styles.css">

<head>
<div class="header stack-top">
        <?php
        include "header.php";
        ?>
    </div>
    <meta charset="UTF-8">
</head>

<body>
<div class = "box">
    <div class="form2">
        <form id="coinFlipForm" >
            <div class="title">Coin Flip</div>
            <div class="subtitle">Make a trade using the coin flip algorithm</div>

            <div class="input-container ic1">
                <input type="text" id="ticker" name="ticker" placeholder=" " class = "input"><br>
                <div class="cut"></div>
                <label for="ticker" class="placeholder">Stock Ticker</label><br>
            </div>

            <div class="input-container ic2">
            <input type="text" id="amount" name="amount" placeholder=" " class = "input" ><br><br>
                    <div class="cut"></div>
                <label for="amount" class="placeholder" name="amount" >Amount To Wager</label><br>
            </div>

            <div class="input-container ic2">
                <input type="date" id="date" name="date" placeholder=" " class = "input"><br>
                    <div class="cut"></div>
                <label for="date" name="date" class="placeholder" >Date to simulate</label><br>
            </div>
                <button type ="button" onclick= "coinFlip()" class = "submit">Try it</button>
        </form>
    </div>
</div>
</body>

<p id="demo"></p>

<script>
    function coinFlip() {
        var ticker = document.getElementById("coinFlipForm").elements[0].value;
        var startMoney = document.getElementById("coinFlipForm").elements[1].value;
        var startReference = document.getElementById("coinFlipForm").elements[1].value;
        var start = document.getElementById("coinFlipForm").elements[2].value;
        var end = document.getElementById("coinFlipForm").elements[2].value;
        var limit = 50000;
        var timespan = 'minute';
        var multiplier = '1';
        var url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`
        var algorithm = "coinFlip";

        var pricesArray = [];
        var timesArray = [];
        axios.get(url)
            .then(response => {
                for (let i = 0; i < response.data.results.length; i++) {
                const bar = response.data.results[i];
                const date = new Date(bar.t);
                pricesArray.push(bar.c);
                timesArray.push(date);
            }
                let totalStocks = 0;

                for(let j=0; j<pricesArray.length; j++){
                    let coin = Math.floor((Math.random() * 100) + 1);
                    let stocksAllowed  = startMoney / pricesArray[j] ; 
                    let stocksToPurchase = Math.floor(Math.random() * stocksAllowed);
                    if (coin <50 && startMoney>pricesArray[j]*stocksToPurchase)
                    {
                        startMoney = startMoney - pricesArray[j]*stocksToPurchase;
                        totalStocks = totalStocks + stocksToPurchase;
                    }
                    else if (coin >50 && totalStocks>0)
                    {
                        startMoney = startMoney + pricesArray[j]*stocksToPurchase;
                        totalStocks = totalStocks - stocksToPurchase;
                    }
                }

                if (totalStocks>0) // selloff stocks at EOD
                {
                    startMoney = startMoney + totalStocks* pricesArray[pricesArray.length -1];
                    totalStocks = 0;
                }


                $(document).ready(function () {
                    createCookie("ticker", ticker, "10");
                    createCookie("start", start, "10");
                    createCookie("startMoney", startMoney, "10");
                    createCookie("startReference", startReference, "10");
                    createCookie("algorithm", algorithm, "10");
                });

                document.getElementById("demo").innerHTML = startMoney;
        })
        .catch(error => {
                console.log("error")
        })
    }

    function createCookie(name, value, days) {
        var expires;
        
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        
        document.cookie = escape(name) + "=" + 
            escape(value) + expires + "; path=/";
    }
</script>

</html>
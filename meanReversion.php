<?php
session_start();
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

    <div class="header stack-top">
        <?php
        include "header.php";
        ?>
    </div>

    <link rel="stylesheet" href="styles.css">

<head>
    <meta charset="UTF-8">
</head>

<body>
<div class = "box">
    <div class="form">
        <form id="meanReversionForm" >
            <div class="title">Mean Reversion</div>
            <div class="subtitle">Make a trade using the mean reversion algorithm</div>

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

            <div class="input-container ic2">
                <input type="date" id="dayBefore" name="dayBefore"  placeholder=" " class = "input"><br>
                    <div class="cut"></div>
                <label for="dayBefore" name="dayBefore"  class="placeholder">Day for mean</label><br>
            </div>

                <button type ="button" onclick= "meanReversion()" class = "submit">Try it</button>
        </form>
    </div>
</div>
<p id="demo"></p>

<script>

function meanReversion() {
        var ticker = document.getElementById("meanReversionForm").elements[0].value;
        var startMoney = document.getElementById("meanReversionForm").elements[1].value;
        var startReference = document.getElementById("meanReversionForm").elements[1].value;
        var start = document.getElementById("meanReversionForm").elements[2].value;
        var end = document.getElementById("meanReversionForm").elements[2].value;
        var dayBefore = document.getElementById("meanReversionForm").elements[3].value;

        var limit = 50000;
        var timespan = 'minute';
        var multiplier = '1';
        var url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${dayBefore}/${dayBefore}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`
        var url2 = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`

        let totalStocks = 0; // amount of stocks currently owned
        let amountToSpend = 0; //amount to spend on a stock at a given time, currency
        let amountToSell = 0 ;//amount to sell of a stock at a given time, currency
        let stocksToBuy = 0; //amount to sell of a stock at a given time, stocks
        let stocksToSell = 0;//amount to sell of a stock at a given time, stocks
        let dollarAmountOfStocksOwned = 0;
        
        var algorithm = "meanReversion";
        let count = 0
        let sum = 0
        let average = 0

        var pricesArray = [];
        var timesArray = [];
        var dayBeforePrices = [];
        axios.get(url)
            .then(response => {
                for (let i = 0; i < response.data.results.length; i++) {
                const bar = response.data.results[i];
                dayBeforePrices.push(bar.c);
                sum+=bar.c;
                count++;
            } 
            average = sum / count  ; 

        })
        .catch(error => {
                console.log("error")
        })

        axios.get(url2)
            .then(response => {
                for (let i = 0; i < dayBeforePrices.length; i++)
                {
                    const bar = response.data.results[i];
                    pricesArray.push(bar.c);
                    let ratio = average / bar.c;
                    let stocksAllowed  = startMoney / pricesArray[i] ; 
                    if (stocksAllowed > 1)
                    {
                        if (ratio < 1 && startMoney>0) //BUY
                        {
                            // console.log(ratio) ;
                            if (ratio>.95 && ratio<1)//buy with 5% of your money
                            {
                                amountToSpend = startMoney *.03;
                            }
                            else if (ratio>.90 && ratio<.95)//buy with 10% of your money
                            {
                                amountToSpend = startMoney *.06;                         
                            }
                            else if (ratio>.85 && ratio<.90)//buy with 15% of your money
                            {
                                amountToSpend = startMoney *.09;                        
                            }
                            else if (ratio<.85) //buy with 20% of your money
                            {
                                amountToSpend = startMoney *.12;                     
                            }
                            totalStocks+=stocksToBuy;  // calculate how many stocks you own now
                            dollarAmountOfStocksOwned += stocksToBuy * pricesArray[pricesArray.length -1] ;
                            stocksToBuy = amountToSpend / pricesArray[pricesArray.length -1] ; // calculate how many stocks to buy
                            startMoney -= amountToSpend ; // calculate money in your account
                        }
                    }

                    if (ratio > 1 && totalStocks>0) //SELL
                    {

                        if (ratio>1 && ratio<1.05)//sell  5%
                        {
                            amountToSell = totalStocks/ pricesArray[i] *.03 ; 
                        }
                        else if (ratio>1.05 && ratio<1.10)//sell 10% 
                        {
                            amountToSell = totalStocks/ pricesArray[i] *.06 ;                         
                        }
                        else if (ratio>1.10 && ratio<1.15)//sell 15%
                        {
                            amountToSell = totalStocks/ pricesArray[i] *.09 ;                        
                        }
                        else if (ratio>1.15) //sell 20%
                        {
                            amountToSell = totalStocks/ pricesArray[i] *.12 ;                     
                        }
                        totalStocks-=stocksToSell;  // calculate how many stocks you own now
                        dollarAmountOfStocksOwned -= stocksToBuy * pricesArray[i] ;
                        stocksToSell = amountToSell / pricesArray[i] ; // calculate how many stocks to sell
                        startMoney -= amountToSell ; // calculate money in your account
                    }  
                    if (totalStocks>0) // selloff stocks at EOD
                    {
                        startMoney = startMoney + totalStocks* pricesArray[pricesArray.length-1];
                        totalStocks = 0;
                    }
                    document.getElementById("demo").innerHTML = startMoney;
                }
                $(document).ready(function () {
                    createCookie("ticker", ticker, "10");
                    createCookie("start", start, "10");
                    createCookie("startMoney", startMoney, "10");
                    createCookie("startReference", startReference, "10");
                    createCookie("algorithm", algorithm, "10");
                });
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
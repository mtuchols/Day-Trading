require('dotenv').config();
const axios = require('axios')

const startDate = '2022-03-29'
const endDate = '2022-03-29'

function getAggregateBars(ticker, start, end, limit, timespan, multiplier) {
    // const url = `https://polygon.io/v2/historic/${multiplier}/${timespan}/${symbol}?from=${start}&to=${end}&limit=${limit}`
    const url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=${process.env.API_KEY}`
    return axios.get(url)
}
const prices = [];

function printAggregateBars(ticker, start, end) {

    const limit = 50000
    const timespan = 'minute'
    const multiplier = '1'
    //const prices = [];
    const time = [];
    getAggregateBars(ticker, start, end, limit, timespan, multiplier)
        .then(response => {
            for (let i = 0; i < response.data.results.length; i++) {
                const bar = response.data.results[i];
                prices.push(bar.c);
            }
            let startMoney = 10000
            let totalStocks = 0
            for(var i=0; i<prices.length; i++){
                //console.log(prices[i]);
                let coin = Math.floor((Math.random() * 100) + 1)

                let stocksAllowed  = startMoney / prices[i] ; 
                let stocksToPurchase = Math.floor(Math.random() * stocksAllowed);
                if (coin <50 && startMoney>prices[i]*stocksToPurchase)
                {
                    //console.log(' buy!');
                    startMoney = startMoney - prices[i]*stocksToPurchase;
                    totalStocks = totalStocks + stocksToPurchase;
                }
                else if (coin >50 && totalStocks>0)
                {
                    //console.log(' sell!');
                    startMoney = startMoney + prices[i]*stocksToPurchase;
                    totalStocks = totalStocks - stocksToPurchase;
                }
            }
            console.log('total stocks accumulated before EOD selloff: ');
            console.log(totalStocks);
            if (totalStocks>0) // selloff stocks at EOD
            {
                startMoney = startMoney + totalStocks* prices[prices.length -1];
                totalStocks = 0;
            }
            console.log('total stocks: ');
            console.log(totalStocks);

            console.log('Money total: ');
            console.log(startMoney);
        })
        .catch(error => {
            console.log(error)
        })
}
/*
function coinFlip(){
    let buy = false;
    let coin = Math.floor(Math.random() * 2);
    if (coin == 0)
    {
        console.log('buy');
    }
    else if (coin ==1)
    {
        console.log('sell');
    }
}*/
printAggregateBars('AAPL', startDate, endDate);



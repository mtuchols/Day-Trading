const axios = require('axios')

const dayBeforeStartDate = '2021-04-06'
const dayBeforeEndDate = '2022-04-06'

const startDate = '2021-04-07'
const endDate = '2021-04-07'

function getAggregateBars(ticker, start, end, limit, timespan, multiplier) {
    // const url = `https://polygon.io/v2/historic/${multiplier}/${timespan}/${symbol}?from=${start}&to=${end}&limit=${limit}`
    const url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`
    return axios.get(url)
}

function getDailyAverage(ticker, start, end) {
    const dayBeforePrices = [];
    const prices = [];
    const limit = 50000
    const timespan = 'day'
    const multiplier = '1'
    let count = 0
    let sum = 0
    let average = 0
    let startMoney = 10000; // amount of money in your account
    let totalStocks = 0; // amount of stocks currently owned
    let amountToSpend = 0 //amount to spend on a stock at a given time, currency
    let amountToSell = 0 ;//amount to sell of a stock at a given time, currency
    let stocksToBuy = 0; //amount to sell of a stock at a given time, stocks
    let stocksToSell = 0;//amount to sell of a stock at a given time, stocks
    let dollarAmountOfStocksOwned = 0;

    getAggregateBars(ticker, start, end, limit, timespan, multiplier)
        .then(response => {
            for (let i = 0; i < response.data.results.length; i++) {
                const bar = response.data.results[i];
                dayBeforePrices.push(bar.c);
                sum+=bar.c;
                count++;
            }
            average = sum / count  ;
            //console.log(average);

            for (let i = 0; i < dayBeforePrices.length; i++)
            {
                const bar = response.data.results[i];
                prices.push(bar.c);
                let ratio = average / bar.c;
                //console.log('ratio   ' + ratio);
                if (ratio < 1 && startMoney>0) //BUY
                {
                    console.log('buy!');
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
                    dollarAmountOfStocksOwned += stocksToBuy * prices[prices.length -1] ;
                    stocksToBuy = amountToSpend / prices[prices.length -1] ; // calculate how many stocks to buy
                    startMoney -= amountToSpend ; // calculate money in your account
                }
                if (ratio > 1 && totalStocks>0) //SELL
                {
                    // console.log(ratio) ;
                    console.log('sell!');

                    if (ratio>1 && ratio<1.05)//sell  5%
                    {
                        amountToSell = totalStocks/ prices[i] *.03 ; 
                    }
                    else if (ratio>1.05 && ratio<1.10)//sell 10% 
                    {
                        amountToSell = totalStocks/ prices[i] *.06 ;                         
                    }
                    else if (ratio>1.10 && ratio<1.15)//sell 15%
                    {
                        amountToSell = totalStocks/ prices[i] *.09 ;                        
                    }
                    else if (ratio>1.15) //sell 20%
                    {
                        amountToSell = totalStocks/ prices[i] *.12 ;                     
                    }
                    totalStocks-=stocksToSell;  // calculate how many stocks you own now
                    dollarAmountOfStocksOwned -= stocksToBuy * prices[i] ;
                    stocksToSell = amountToSell / prices[i] ; // calculate how many stocks to sell
                    startMoney -= amountToSell ; // calculate money in your account
                }  
                // console.log('dollarAmountOfStocksOwned ' + dollarAmountOfStocksOwned);    
                // console.log('start money ' + startMoney);  
                // console.log('total stocks' + totalStocks); 
                console.log('amountToSell ' + amountToSell);   
            }
            if (totalStocks>0) // selloff stocks at EOD
            {
                startMoney = startMoney + totalStocks* prices[prices.length-1];
                totalStocks = 0;
            }
            console.log(startMoney); 
        })
        .catch(error => {
            console.log(error)
        })
}

getDailyAverage('AAPL', dayBeforeStartDate, dayBeforeEndDate);
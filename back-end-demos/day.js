
const axios = require('axios')

const startDate = '2021-03-16'
const endDate = '2022-03-16'

function getAggregateBars(ticker, start, end, limit, timespan, multiplier) {
    // const url = `https://polygon.io/v2/historic/${multiplier}/${timespan}/${symbol}?from=${start}&to=${end}&limit=${limit}`
    const url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`
    return axios.get(url)
}

function printAggregateBars(ticker, start, end) {

    const limit = 50000
    const timespan = 'day'
    const multiplier = '1'

    getAggregateBars(ticker, start, end, limit, timespan, multiplier)
        .then(response => {
            for (let i = 0; i < response.data.results.length; i++) {
                const bar = response.data.results[i];
                const date = new Date(bar.t);
                console.log(`${date}, ${bar.c}`);
            }
        })
        .catch(error => {
            console.log(error)
        })
}

printAggregateBars('AAPL', startDate, endDate);

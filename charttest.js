const axios = require('axios')
const startDate = '2021-03-16'
const endDate = '2022-03-16'
const limit = 50000
const timespan = 'day'
const multiplier = '1'
function getAggregateBars(ticker, start, end, limit, timespan, multiplier) {
    const url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`
    return axios.get(url)
}
var pricesArray = [];
var timesArray = [];
getAggregateBars(ticker, start, end, limit, timespan, multiplier)
.then(response => {
    for (let i = 0; i < response.data.results.length; i++) {
        const bar = response.data.results[i];
        const date = new Date(bar.t);
        pricesArray[i] = bar.c; 
        timesArray[i] = date ;
        console.log(timesArray[i]);

    }
})
.catch(error => {
    console.log(error)
})



let myChart = document.getElementById('myChart').getContext('2d');
let massPopChart = new Chart(myChart, {
    type:'line',
    data:{
        labels:['A', 'B', 'C', 'D', 'E', 'F'],
        datasets:[{
            label:'Population',
            data:[
                31256,
                23423,
                23434,
                43522,
                23423,
                43233
            ],
            backgroundColor:[
                'green',
                'red',
                'pink',
                'yellow',
                'blue',
                'orange'
            ]
        }]
    },
    options:{}
});

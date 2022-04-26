<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <?php
    include "header.php";
    ?>
    <link rel="stylesheet" href="styles.css">

    <meta name="viewport" content="width = device-width, initial-scale=.5">
    <meta http-equiv="X-UA_Compatible" content="ie=edge">

    <!-- Import AXIOS for API calls -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Import CANVAS for chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    <script>
        function getAggregateBars(ticker, start, end, limit, timespan, multiplier) {
            const url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`

            return axios.get(url);
        }

        function getStockData(tickerText) {
            // document.getElementById("demo").innerHTML = "Hello World";
            var ticky = document.getElementById("tickerText").value;
            console.log("Ticky = ", ticky);
            var url = `https://api.polygon.io/v3/reference/tickers/${ticky}?apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`;
            axios.get(url)
                .then(response => {
                    // for (let i = 0; i < response.data.results.length; i++) {
                    //     const bar = response.data.results[i];
                    //     const date = new Date(bar.t);
                    //     console.log(`${date}, ${bar.c}`);
                    // }
                    const bar = response.data.results;
                    document.getElementById("ticker").innerHTML = "Symbol: " + response.data.results.ticker;
                    document.getElementById("company").innerHTML = "Company: " + response.data.results.name;
                    document.getElementById("description").innerHTML = "Description: " + response.data.results.description;
                    document.getElementById("employees").innerHTML = "# of employees: " + response.data.results.total_employees;
                    document.getElementById("homepage").innerHTML = "Homepage: " + response.data.results.homepage_url;
                    document.getElementById("address").innerHTML = response.data.results.address.address1 + " " + response.data.results.address.city + " " + response.data.results.address.state;

                })
                .catch(error => {
                    console.log(error)
                })
            setTimeout(generateChart(), 1000);
        }
    </script>

    <script>
        function generateChart() {

            let ticker = document.getElementById("tickerText").value;
            const limit = 1000
            const timespan = 'week'
            const multiplier = '1'
            const start = '2021-04-28'
            const end = '2022-04-25'
            const url = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`

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
                })
                .catch(error => {
                    console.log("error")
                })
            // let myChart = document.getElementById('myChart').getContext('2d');
            let massPopChart = new Chart(myChart, {
                width: 320,
                height: 200,

                type: 'line',
                data: {
                    labels: timesArray,
                    datasets: [{
                        label: 'Amount',
                        data: pricesArray,
                        borderWidth: 1,
                    }]
                },
                options: {}
            });
        }
    </script>
</head>

<body>
    <div class="stock">
        <h2>Stock Information Lookup Tool</h2>
        <br>
        <label for="ticker">Enter a NASDAQ ticker:</label>
        <input type="ticker" id="tickerText" name="ticker1" placeholder="AAPL">
        <button onclick="getStockData(tickerText)">Get ticker info</button><br><br>
        <!-- <button onclick="myFunction()">Click me</button><br> -->
        <!-- <p id="demo"></p> -->
        <p id="ticker"></p>
        <p id="company"></p>
        <p id="description"></p>
        <p id="homepage"></p>
        <p id="employees"></p>
        <p id="address"></p>
    </div>
    <div class="chart">
        <canvas id="myChart"></canvas>
    </div>

</body>

</html>
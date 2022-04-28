<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <div class="header stack-top">
        <?php
        include "header.php";
        ?>
    </div>
    <link rel="stylesheet" href="styles.css">

    <meta name="viewport" content="width = device-width, initial-scale=.5">
    <meta http-equiv="X-UA_Compatible" content="ie=edge">

    <!-- Import AXIOS for API calls -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
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
            var dps = [];

            let ticker = document.getElementById("tickerText").value;
            const limit = 1000
            const timespan = 'week'
            const multiplier = '1'
            const start = '2021-04-28'
            const end = '2022-04-25'
            const url2 = `https://api.polygon.io/v2/aggs/ticker/${ticker}/range/${multiplier}/${timespan}/${start}/${end}?adjusted=true&sort=asc&limit=${limit}&apiKey=p4PcUz4rRWTyXBDS6QZJTw07VwMJWZFE`

            var pricesArray = [];
            var timesArray = [];
            axios.get(url2)
                .then(response => {
                    for (let i = 0; i < response.data.results.length; i++) {
                        const bar = response.data.results[i];
                        const date = new Date(bar.t);
                        pricesArray.push(bar.c);
                        timesArray.push(date);
                        dps.push({
                            x: date,
                            y: bar.c
                        });
                    }
                })
                .catch(error => {
                    console.log("error")
                })
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "dark1",
                backgroundColor: "#030e12",
                data: [{
                    type: "line",
                    dataPoints: dps
                }]
            });
            chart.render();
            setTimeout(resize(), 2000);
        }
    </script>
</head>

<body>
    <div class="stock">
        <h2>Stock Information Lookup Tool</h2>
        <br>
        <label for="ticker">Enter a NASDAQ ticker:</label>
        <input type="ticker" id="tickerText" name="ticker1" placeholder="AAPL" oninput="this.value = this.value.toUpperCase()">
        <button onclick=" getStockData(tickerText)">Get ticker info</button><br><br>
        <!-- <button onclick="myFunction()">Click me</button><br> -->
        <!-- <p id="demo"></p> -->
        <p id="ticker"></p>
        <p id="company"></p>
        <p id="description"></p>
        <p id="homepage"></p>
        <p id="employees"></p>
        <p id="address"></p>
    </div>
    <div class="homechart">
        <h2 style="text-align: center">Stock Price History</h2>
        <div id="chartContainer" style="margin-left: 36px; margin-right: 36px; margin-top: 36px; height: 380px; border-radius: 15px; margin-bottom: 24px;"></div>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>
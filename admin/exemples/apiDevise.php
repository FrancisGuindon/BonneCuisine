<html>
    <head>
        <title>test api-taux de change</title>
    </head>
    <body>
        test api-taux de change 
        <br><br>
        <?php
        // set API Endpoint and API key 
		$key = '3036|*qRGo~kJg8XBNyO9zDDMw~mREn4BmpST';
		$source = 'CAD';
		$target = 'USD';
		$format = 'json';
		$qte = '1';

		// Initialize CURL:
		$ch = curl_init('http://api.currencies.zone/v1/quotes/'.$source.'/'.$target.'/'.$format.'?quantity='.$qte.'&key='.$key.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response:
		$exchangeRates = json_decode($json, true);

		// Access the exchange rate values
		echo $exchangeRates['result']['value'];
		echo $exchangeRates['result']['updated'];
        ?>
    </body>
</html>
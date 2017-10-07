<?php
	//Spade API
	// Priv8 tool, If found online contact me: 5p4d3@protonmail.com
	// IP Locator API this is my first API:p
	//Usage? : http://pastebin.com/raw/wN0zXgfx
	define("API","3b46544ce3e0a9d088055b3bf1b1738a58a44f397f0c1c921c8caeee1b6e55fb");
	if(!isset($_GET['ip']) || (empty($_GET['ip'])) ) {
		$ip = filter_var(htmlspecialchars($_GET['ip']), FILTER_SANITIZE_STRING);
		$js = array('ip' => $ip, ':~Spade was here~:' => "No Parameters");
		echo json_encode($js);
	}else{

		function proxy($ip){
				$email = "5p4d3@protonmail.com";
			$res = "http://check.getipintel.net/check.php?ip=".$ip."&contact=".$email."&format=json&flags=m";
			$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $res);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$results = curl_exec($curl);
				curl_close($curl);

			$result = json_decode($results, true);

			$resultx = $result['result'];

			if($resultx == 1){
				$ogmeme = "yes";
			}else{
				$ogmeme = "no";
			}

			return $ogmeme;

		}// function proxy ends here

		if(!filter_var($_GET['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false){
			$ip = $_GET['ip'];
			$location = "http://api.ipinfodb.com/v3/ip-city/?key=".API."&ip=".$ip."&format=json";
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $location);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$resultLocation = curl_exec($curl);
			curl_close($curl);
			$result = json_decode($resultLocation, true);

			$hostname = gethostbyaddr($ip);
			$city = $result['cityName'].", ".$result['regionName'];
			$zip = $result['zipCode'];
			$country = $result['countryName'];
			$country_code = $result['countryCode'];
			$loc = $result['latitude'].",".$result['longitude'];
			$lat = $result['latitude'];
			$long = $result['longitude'];
			$timezone = $result['timeZone'];

			/*$final = '{"ip":"'.$ip.'","hostname":"'.$hostname.'","city":"'.$city.'","region":"'.$region.'","country":"'.$country.'","location":"'.$loc.'","isp":"'.$isp.'","proxy":"'.proxy($ip).'"}';
			var_dump(json_decode($final, true));*/ // << i figure out that im fvcking wrong in here :(

			$final = array('ip' => $ip, 'hostname' => $hostname, 'city' => $city, 'zip' => $zip, 'country' => $country, 'countryCode' => $country_code, 'location' => $loc, 'lat' => $lat, 'long' => $long, 'timezone' => $timezone, 'vpn_user' => proxy($ip));

			echo json_encode($final);

		}else{
			$ip = filter_var(htmlspecialchars($_GET['ip']), FILTER_SANITIZE_STRING);
			$js = array('ip' => $ip, ':~Spade was here~:' => "Not an IP");
			echo json_encode($js);
		}

		
	}
?>
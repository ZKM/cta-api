<?php 
date_default_timezone_set('America/Chicago');

$mapID = $_GET["sid"];
$cta = simplexml_load_file("http://lapi.transitchicago.com/api/1.0/ttarrivals.aspx?key=$apiKey&mapid=$mapID");
$staNm = $cta->eta->staNm;

if ($staNm != null) { 
	echo "<div class=\"twelve columns\"><div class=\"twelve columns\"><h1>$staNm</h1></div>\n<ul id='ctaTracker'>\n";
	foreach ($cta->eta as $cta_info){
		$rt = $cta_info->rt;
		$cta_station = $cta_info->destNm;
		$arrival_time = $cta_info->arrT;
		$stopDirection = $cta_info->stpDe;
		$prdtime = $cta_info->prdt;
		
	//$arrival_time = (int)((time()-strtotime($arrival_time))/60) . " min";

	// Creating Arrival Time
	$arvDateArray = explode(" ",$arrival_time);
	$dateArray = str_split($arvDateArray[0]);
	$year = $dateArray[0].$dateArray[1].$dateArray[2].$dateArray[3];
	$month = $dateArray[4].$dateArray[5];
	$day = $dateArray[6].$dateArray[7];

	$arrival_time = $year.'-'.$month.'-'.$day.' '.$prdDateArray[1];

 	$arrival_time = secs_to_string_compact(strtotime($arrival_time) - strtotime(now));

	// Creating Predicted Time
	$prdDateArray = explode(" ",$prdtime);
	$dateArray = str_split($prdDateArray[0]);
	$year = $dateArray[0].$dateArray[1].$dateArray[2].$dateArray[3];
	$month = $dateArray[4].$dateArray[5];
	$day = $dateArray[6].$dateArray[7];

	$prdtime = $year.'-'.$month.'-'.$day.' '.$prdDateArray[1];

 	$prdtime = secs_to_string_compact(strtotime($prdtime) - strtotime(now));


		switch ($rt) {
			case 'G':
				$rt = 'Green';
				break;

			case 'Org':
				$rt = 'Orange';
				break;

			case 'Brn':
				$rt = 'Brown';
				break;
			
			case 'P':
				$rt = 'Purple';
				break;

			case 'Y':
				$rt = 'Yellow';
				break;

			default:
				$rt = $rt;
				break;
		}

		echo "<li class=\"columns six\"><div class='rt $rt'><h2><a href=\"./?display=$rt\">$rt</a> > $cta_station</h2></div>\n<div class='arrT'><h3>arrival time:</h3> <strong>$arrival_time</strong></div>\n<div class='prdt'><h3>predicted time:</h3> <strong>$prdtime</strong></div>\n<div class='stpDe'><h3>direction:</h3> <strong>$stopDirection</strong></div>\n<hr /></li>\n";
	}

	echo "\n</ul></div>";
}
else {
	echo "<h1> Sorry no results</h1>\n<a href=\"index.php\">Go Back</a>";
}
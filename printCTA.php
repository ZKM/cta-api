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
		
//		$arrival_time = substr($arrival_time, 9);
		$arrival_time = (int)((time()-strtotime($arrival_time))/60) . " min";
//		$subAt = time() -  strtotime($prdtime);
//		$arrival_time = floor($subAt / 3600) . " min";

//		$prdtime = substr($prdtime, 9);
//		$subPrd = time() -  strtotime($prdtime);
//		$prdtime = floor($subPrd / 3600) . " min";
		$prdtime = (int)((time()-strtotime($prdtime))/60) . " min";


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
<?php 
$mapID = $_GET["sid"];
$cta = simplexml_load_file("http://lapi.transitchicago.com/api/1.0/ttarrivals.aspx?key=$apiKey&mapid=$mapID");
$staNm = $cta->eta->staNm;

echo "<div class=\"twelve columns\"><div class=\"twelve columns\"><h1>$staNm</h1></div>\n<ul id='ctaTracker'>\n";

foreach ($cta->eta as $cta_info){
	$rt = $cta_info->rt;
	$cta_station = $cta_info->destNm;
	$arrival_time = $cta_info->arrT;
	$stopDirection = $cta_info->stpDe;
	$prdtime = $cta_info->prdt;
	
	$arrival_time = substr($arrival_time, 9);
	$arrival_time = date('h:i:s A', strtotime($arrival_time));
	$prdtime = substr($prdtime, 9);
	$prdtime = date('h:i:s A', strtotime($prdtime));

//	$prdtime = date('h:i:s A');	

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
	echo "<li class=\"columns six\"><div class='rt $rt'><h2><a href=\"./?display=$rt\">$rt</a> > $cta_station</h2></div>\n<div class='arrT'><h3>arrival time:</h3> $arrival_time</div>\n<div class='prdt'><h3>predicted time:</h3> $prdtime</div>\n<div class='stpDe'><h3>direction:</h3> $stopDirection</div>\n<hr /></li>\n";
}

echo "\n</ul></div>";

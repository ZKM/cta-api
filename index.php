<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>CTA API</title>
	<link href="../styles/css/app.css" media="screen, projector, print" rel="stylesheet" type="text/css" />
	<link href='../styles/css/style.css' rel='stylesheet'>
	<script src="../js/foundation/modernizr.foundation.js"></script>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../images/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../images/ico/favicon.png">
	<!-- [if lt IE 8]>
	<link rel="shortcut icon" href="../images/ico/favicon.ico">
	<![endif]-->
</head>
<body>
<div class="row">
		<div class="twelve columns">
			<?php
				//$cta = simplexml_load_file("http://cta.local:8888/sample-data.xml");

			/* Station IDs
			?sid=
				Brown Line:
					Kimball - 41290	
					Kedzie - 41180
					Francisco - 40870
					Rockwell - 41010
					Western - 41480
					Damen - 40090
					Montrose - 41500
					Irving Park - 41460
					Addison - 41440
					Paulina - 41310
					Southport - 40360
					Belmont - 41320
					Wellington - 41210
					Diversy - 40530
					Fullerton - 41220
					Armitage - 40660
					Sedgwick - 40800
					Chicago - 40710
					Merchandise Mart - 40460
					Washington/Wells - 40730
					Quincy - 40040
					LaSalle/Van Buren - 40160
					Harold Washington Library-State/Van Buren - 40850
					Adams/Wabash - 40680
					Madison/Wabash - 40640
					Randolph/Wabash - 40200
					State/Lake - 40260
					Clark/Lake - 40380

			*/

				$mapID = $_GET["sid"];

				include('secret.php');

				$cta = simplexml_load_file("http://lapi.transitchicago.com/api/1.0/ttarrivals.aspx?key=$apiKey&mapid=$mapID");
				


				$staNm = $cta->eta->staNm;

				echo "<h1>$staNm</h1>\n<ul id='ctaTrancker'>\n";
				foreach ($cta->eta as $cta_info){
					$rt = $cta_info->rt;
					$cta_station = $cta_info->destNm;
					$arrival_time = $cta_info->arrT;
					$stopDirection = $cta_info->stpDe;
					$prdtime = $cta_info->prdt;
				
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

					echo "<li><div class='rt $rt'><h2>$rt > $cta_station</h2></div>\n<div class='arrT'><h3>arrival time:</h3> $arrival_time</div>\n<div class='prdt'><h3>prd time:</h3> $prdtime</div>\n<div class='stpDe'><h3>direction:</h3> $stopDirection</div>\n<hr /></li>\n";
				}

				echo "\n</ul>";
			?>
		</div>
	</div>
</body>
</html>
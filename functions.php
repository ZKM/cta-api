<?php
		function ctaURL($mapID) {
				$cta = simplexml_load_file("http://lapi.transitchicago.com/api/1.0/ttarrivals.aspx?key=$apiKey&mapid=$mapID");
				$staNm = $cta->eta->staNm;

				$trainColor = "<h1>$staNm</h1>\n<ul id='ctaTracker'>\n";

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

					$trainRt = "<li><div class='rt $rt'><h2>$rt > $cta_station</h2></div>\n<div class='arrT'><h3>arrival time:</h3> $arrival_time</div>\n<div class='prdt'><h3>predicted time:</h3> $prdtime</div>\n<div class='stpDe'><h3>direction:</h3> $stopDirection</div>\n<hr /></li>\n";
				}

				$trainCl = "\n</ul>";

				return $trainColor . $trainRt . $trainCl;

			} 

		//	echo ctaURL();

			?>

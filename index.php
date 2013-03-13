<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>CTA API</title>
	<link href="./styles/css/app.css" media="screen, projector, print" rel="stylesheet" type="text/css" />
	<link href='./styles/css/style.css' rel='stylesheet'>
	<script src="./js/foundation/modernizr.foundation.js"></script>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="./images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="./images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="./images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="./images/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="./images/ico/favicon.png">
	<!-- [if lt IE 8]>
	<link rel="shortcut icon" href="../images/ico/favicon.ico">
	<![endif]-->
</head>
<body>
<div class="row">
		<div class="twelve columns">
			<?php

				if (empty($_GET["display"])) $action = '';
				else $action = strtoupper($_GET['display']);

				switch($action) {
					case 'RED': 

					// Query Database
					include('con.php');
					$query = "SELECT  `sid` ,  `station` FROM  `red`";
					$paths = @mysql_query($query); 

					if (!$paths) {
						echo "<p><strong>Query error:</strong><br /> $query</p>"; // query error
						break; // terminate case
					}

					echo '<div class="row"><div class="twelve stations columns Red"><h1>Red Line</h1></div></div>';

					// loop through
					while($train = mysql_fetch_array($paths, MYSQL_BOTH)) {
					
					$mapID = $train['sid'];

					echo '<div class="three stations columns"><a class="panel" href="?display=red&sid=' . $mapID . '">' . $train['station'] . '</a></div>';

					} // while train
					echo "</div>";

					break;

					case 'BROWN': // display stations

					// Query Database
					include('con.php');
					$query = "SELECT  `sid` ,  `station` FROM  `brown`";
					$paths = @mysql_query($query); 

					if (!$paths) {
						echo "<p><strong>Query error:</strong><br /> $query</p>"; // query error
						break; // terminate case
					}

					echo '<div class="row"><div class="twelve stations columns Brown"><h1>Brown Line</h1></div></div>';

					// loop through
					while($train = mysql_fetch_array($paths, MYSQL_BOTH)) {
					
					$mapID = $train['sid'];

					echo '<div class="three stations columns"><a class="panel" href="?display=brown&sid=' . $mapID . '">' . $train['station'] . '</a></div>';

					} // while train
					echo "</div>";

					break;

					default:
					case '':
						echo '<div class="twelve columns"><h1>Where you trying to go?</h1></div>';
						echo '<div class="six columns color Blue"><h2><a class="panel" href="?display=blue">Blue Line</a></h2></div>';
						echo '<div class="six columns color Brown"><h2><a class="panel" href="?display=brown">Brown Line</a></h2></div>';
						echo '<div class="six columns color Green"><h2><a class="panel" href="?display=green">Green Line</a></h2></div>';
						echo '<div class="six columns color Orange"><h2><a class="panel" href="?display=orange">Orange Line</a></h2></div>';
						echo '<div class="six columns color Pink"><h2><a class="panel" href="?display=pink">Pink Line</a></h2></div>';
						echo '<div class="six columns color Purple"><h2><a class="panel" href="?display=purple">Purple Line</a></h2></div>';
						echo '<div class="six columns color Red"><h2><a class="panel" href="?display=red">Red Line</a></h2></div>';
						echo '<div class="six columns color Yellow"><h2><a class="panel" href="?display=yellow">Yellow Line</a></h2></div>';


						break;

				} // END DISPLAY switch

				// START SID switch
				if (empty($_GET["sid"])) $ctaTime = '';
				else $ctaTime = strtoupper($_GET['sid']);

				switch ($ctaTime) {
					case '':
					// code...
						break;
					default:
						echo "<style>.stations{display:none;}</style>";
						include('printCTA.php');
					break;
					
				}
				?>
</div>
<?php include_once("analyticstracking.php") ?>
</body>
</html>
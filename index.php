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

				if (empty($_GET["display"])) $action = 'DISPLAY';
				else $action = strtoupper($_GET['display']);

				switch($action) {
					default:
					case 'BROWN': // display stations

					// Query Database
					include('con.php');
					$query = "SELECT  `sid` ,  `station` FROM  `brown`";
					$paths = @mysql_query($query); 

					if (!$paths) {
						echo "<p><strong>Query error:</strong><br /> $query</p>"; // query error
						//break; // terminate case
					}

					echo '<div class="row"><div class="twelve columns"><h1>Brown Line</h1></div></div>';
					//include('functions.php');

					// loop through
					while($train = mysql_fetch_array($paths, MYSQL_BOTH)) {
					
					$mapID = $train['sid'];

					echo '<div class="three columns"><a class="panel" href="?display=brown&sid=' . $mapID . '">' . $train['station'] . '</a></div>';

					} // while train
					//break;
					//$mapID = $_GET["sid"];
				}
					?>
	</div>
</div>
</body>
</html>
<?php 
	if (file_exists('includes/configLocal.php')) {
		include_once 'includes/configLocal.php';
	} else {
		include_once 'includes/config.php';
	}


	######################################
	#	following was attempt to abstract pdo-sql from rest of file, didn't have time to make it work, but left here for future use 
	######################################
	// function filter($sql){
	// 	try {
	// 		$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
	// 		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 		$venues = $pdo->query($sql);
	// 		return $venues;
		
	// 		$pdo = null; // stops pdo-sql
	// 	}
	// 	catch (PDOException $e) {
	// 			die( $e->getMessage() );
	// 	}
	// } // end Filter

	// function listStates() {
	// 	$sql = "SELECT State FROM venues GROUP BY State";
	// 	return filter($sql);
	// }

	// function filterByState ($state) {
	// 	$sql = 'select * from venues where state="'.
	// 		$state
	// 		.'"';
	// 	return filter($sql);
	// }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Catalog | Topazity</title>
	<link rel="icon" href="images/misc/blue-topaz-transparent.ico" type="image/icon" sizes="16x16">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body id="top">
	
	<div id="wrapper">
	
	<?php include 'includes/header.php'; ?>

<main>

	<div class="jumbotron">
		<h1>Catalog<br>of upcoming events</h1>
	</div>
	<!-- <p>Each year, the locations change! We want to expand our festivals so people like YOU can enjoy the fun. See you there!</p>
	<p>Any questions? Visit our<a class="mediaLinks" href="about.html">ABOUT</a>page.</p> -->
	

	<p><?php // debugger

		// if (isset($_GET["filter"])) {
		// 	echo "<p>FilterType=";
		// 	var_dump($_GET["filter"]);
		// 	echo "</p><p>FilterCriteria=";
		// 	var_dump($_GET[$_GET["filter"]]);
		// 	echo "</p>";
		// }

	?></p>

	<!-- dropdown menu for filters, state, venues, date range? -->
 	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Filters <span class="caret"></span></button>
		<ul class="dropdown-menu">
			<?php if (isset($_GET["filter"]) && !($_GET["filter"]=="false")) {
				echo '<li><a tabindex="1" href="catalog.php">Show All</a></li>';
			}?>
			<li class="dropdown-submenu">
				<a class="test" tabindex="1" href="#">State <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php // pdo-sql to get list of states, loop to put them in li
						try {
							$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT State FROM venues GROUP BY State";
							$venues = $pdo->query($sql);
							while ($row = $venues->fetch()) {
								echo 
								'<li>
									<a tabindex="2" href="catalog.php?filter=State&State='.
									$row["State"]
									.'">'.
									$row["State"]
									.'</a>
								</li>'
								;
							};
							$pdo = null;
						}
						catch (PDOException $e) {
							die( $e->getMessage() );
						}
					?>
				</ul>
			</li>
			<li class="dropdown-submenu">
				<a class="test" tabindex="1" href="#">City <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php // pdo-sql to get list of cities, loop to put them in li
						try {
							$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT City FROM venues GROUP BY City";
							$venues = $pdo->query($sql);
							while ($row = $venues->fetch()) {
								echo 
								'<li>
									<a tabindex="2" href="catalog.php?filter=City&City='.
									$row["City"]
									.'">'.
									$row["City"]
									.'</a>
								</li>'
								;
							};
							$pdo = null;
						}
						catch (PDOException $e) {
							die( $e->getMessage() );
						}
					?>
				</ul>
			</li>
			<li class="dropdown-submenu">
				<a class="test" tabindex="1" href="#">Venue <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php // pdo-sql to get list of venues by name, loop to put them in li
						try {
							$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT VenueName FROM venues GROUP BY VenueName";
							$venues = $pdo->query($sql);
							while ($row = $venues->fetch()) {
								echo 
								'<li>
									<a tabindex="2" href="catalog.php?filter=VenueName&VenueName='.
									$row["VenueName"]
									.'">'.
									$row["VenueName"]
									.'</a>
								</li>'
								;
							};
							$pdo = null;
						}
						catch (PDOException $e) {
							die( $e->getMessage() );
						}
					?>
				</ul>
			</li>
			<li class="dropdown-submenu">
				<a class="test" tabindex="1" href="#">Date <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php // pdo-sql to get list of dates, loop to put them in li
						try {
							$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT Date FROM venues GROUP BY Date";
							$venues = $pdo->query($sql);
							while ($row = $venues->fetch()) {
								echo 
								'<li>
									<a tabindex="2" href="catalog.php?filter=Date&Date='.
									$row["Date"]
									.'">'.
									date_format(new DateTime($row["Date"]),"M d, Y")
									.'</a>
								</li>'
								;
							};
							$pdo = null;
						}
						catch (PDOException $e) {
							die( $e->getMessage() );
						}
					?>
				</ul>
			</li>
		</ul>
	</div>

	<hr>
	<!-- main content of page, list of venues, with filters if active -->
	<table class="catalogTable">
		<tbody>
			<?php // pdo-sql to get list of venues, loop to put to page
				try {
					$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					// check if filter active
					if (isset($_GET["filter"])) {
						// switch on which filter selected, default same as no filter selected
						switch ($_GET["filter"]) {
							case "State":
								$sql = 'select * from venues where state="'.$_GET["State"].'" order by state';
								break;
							
							case "City":
								$sql = 'select * from venues where city="'.$_GET["City"].'" order by Date';
								break;
							
							case "VenueName":
								$sql = 'select * from venues where VenueName="'.$_GET["VenueName"].'" order by Date';
								break;
							
							case "Date":
								$sql = 'select * from venues where date="'.$_GET["Date"];
								break;
							
							default:
								$sql = 'select * from venues order by Date';
								break;
						}
					} elseif (!isset($_GET["filter"])) {
						$sql = 'select * from venues order by Date';
					}
					// echo "<p>".$sql."</p>"; // debugger
					$venues = $pdo->query($sql);
					// main loop for getting list
					while ($row = $venues->fetch()) {
						echo 
						'<tr>
							<td>
								<p id="cataloginfo">'.date_format(new DateTime($row["Date"]),"M d, Y").'</p>
								<p id="cataloginfo"><strong>'.$row["VenueName"].'</strong></p>
								<p id="cataloginfo">'.$row["City"].', '.$row["State"].'</p>
							</td>
							<td><img class="catalogImages" src="images/venues/'.$row["VenueImage"]
								.'" alt="'.$row["VenueName"].' '.
								$row["City"].'"></td>
						</tr>'
						;
					};
					$pdo = null;
			    }
			    catch (PDOException $e) {
			      die( $e->getMessage() );
			    }
			  ?> 

		</tbody>
	</table>
</main>
	
<footer>
	<p>&copy; 2020 Topazity. All rights reserved.<br>
	   Gabriel Soto & Brenden Rasmussen<br>
	Due Date: February 23, 2020<br>
	</p>
</footer>
</div> <!-- end wrapper -->
<script>
	$(document).ready(function(){
		$('.dropdown-submenu a.test').on("click", function(e){
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});
});
</script>
</body>
</html>
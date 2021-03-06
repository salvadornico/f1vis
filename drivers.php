<?php

	$active_page = "Drivers";

	require_once 'partials/header.php';


	$result = querySQL("SELECT drivers.driverRef AS driverId, CONCAT(drivers.forename, ' ', drivers.surname) AS 'driverName', 
		min(races.date) AS 'debut'
		FROM driverstandings JOIN drivers ON drivers.driverId = driverstandings.driverId
		JOIN races ON races.raceId = driverstandings.raceId
		GROUP BY driverName ORDER BY debut DESC");

	$debuts = [];
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			extract($row);
			// extract year from debut date
			$date_arr = explode('-', $debut);
			$debut = $date_arr[0];

			// array for displaying list
			$new_driver = [$debut => [$driverId, $driverName]];
			$debuts[] = $new_driver;
		}
	}

	// merge drivers with same year debut in array
	$collated_debuts = [];
	foreach ($debuts as $debut) {
		foreach ($debut as $year => $driver) {
			// if year is in array
			if (yearInArray($year, $collated_debuts)) {
				// append driver to correct year
				array_push($collated_debuts[$year], $driver);
			} else {
				// create new year entry with driver included
				$collated_debuts[$year] = [$driver];			
			}
		}
	}
?>

	<main>

		<div class="container">

			<h2>Formula 1 drivers across history</h2>

			<!-- Search form -->
			<div class="row">

				<form method="POST" action="single-driver.php" autocomplete="off">
					
		        	<div class="input-field col s12 m6">
		          		<i class="material-icons prefix">search</i>
		          		<input type="text" name="driver-search" id="driver-search" class="autocomplete">
		          		<label for="driver-search">Search</label>
		        	</div>

		        	<div class="input-field col s10 offset-s2 m2">
		        		<button class="waves-effect waves-light btn green darken-3" name="submit_driver_search" value="search">
							Go
						</button>
		        	</div>

				</form>

	      	</div> <!-- /search form -->

	      	<div class="row">
	      		
				<table>

					<?php 
						foreach ($collated_debuts as $year => $drivers) {
							echo "<tr>
									<td>$year</td>
									<td>";
									foreach ($drivers as $driver) {
										echo "<a class='driver-btn waves-effect waves-light btn yellow darken-3' href='single-driver.php?id=$driver[0]&name=$driver[1]'>".$driver[1]."</a>";
									}
							echo "</td></tr>";
						}
					?>

				</table>

	      	</div>


		</div> <!-- /container -->
		
	</main>

	<script>

		// Autocomplete script for search box
		$(document).ready( function() {

			$('input.autocomplete').autocomplete({
				data: {
						<?php

							foreach ($debuts as $debut) {
								foreach ($debut as $year => $driver) {
									echo '"'.$driver[1].'": null,';
								}
							}

						?>
				},
    			limit: 20,
	    		minLength: 1,
			})
		})

	</script>

<?php

	require_once 'partials/footer.php';

?>
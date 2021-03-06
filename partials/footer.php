
		<footer class="page-footer green darken-4" id="footer">
	    	<div class="container">
	        	<div class="row">
	            	<div class="col l6 s12">
	                	<h5 class="white-text">monoposto</h5>
	                	<p class="grey-text text-lighten-4">
	                		Visualizing Formula 1 data across history.
	                		<br>
	                		Data courtesy of the <a href="http://ergast.com/mrd/" target="_blank">Ergast Developer API</a>.
	                		<br><br>
	                		<a href="https://github.com/salvadornico/f1vis" target="_blank">View source code</a>.
	                	</p>
	              	</div>
	              	<div class="col l4 offset-l2 s12">
		                <h5 class="white-text">sections</h5>
		                <ul>
		                	<?php printNav("grey-text text-lighten-3"); ?>
		                </ul>
	              	</div>
	            </div>
	        </div>
	        <div class="footer-copyright">
	        	<div class="container">
	            	&copy; 2017 Monoposto. All content is property of their respective owners.
	            </div>
	        </div>
        </footer>

        <!-- Sitewide custom JS -->
	  	<script src="js/scripts.js"></script>

	  	<!-- Custom JS for specific pages -->
	  	<?php

	  		if ($is_driver_page) { echo '<script src="js/singleDriverPage.js"></script>'; }
	  		switch ($active_page) {
	  			case 'Dashboard':
	  				echo '<script src="js/dashboard.js"></script>';
	  				break;
	  			case 'Home':
	  				echo '<script src="js/homePage.js"></script>';
	  				break;	  			
	  			default:
	  				break;
	  		}

	  	?>

	</body>

</html>
<?php
    $page_title = 'Members';
    include ('includes/header.html');
    
    // Fetch member data from the database
    $query = "SELECT * FROM members";
    $result = mysqli_query($dbc, $query);


    echo'<h1 class="about_taital">Member List</h1>
    <table>';
	
		// Table header:
			echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
			<tr>
				<td align="left"><b>Student ID</b></td>
				<td align="left"><b>Name</b></td>
				<td align="left"><b>Position</b></td>
				<td align="left"><b>Registration Date</b></td>
			</tr>
		';
			
			// Fetch and print all the records:
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo '<tr>
					<td align="left">' . $row['student_id'] . '</td>
					<td align="left">' . $row['name'] . '</td>
					<td align="left">' . $row['position'] . '</td>
					<td align="left">' . $row['registration_date'] . '</td>
				</tr>
				';
			}
			?>
    </table>
	
	<!-- footer section -->
	<?php
		include ('includes/footer.html');
	?>
	<!-- footer section end -->
	
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript --> 
    <script src="js/owl.carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>
</html>

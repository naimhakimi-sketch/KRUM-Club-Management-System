<?php
    $page_title = 'Members';
    include('../includes/admin-header.html');
    
    // Fetch member data from the database
    $query = "SELECT * FROM members ORDER BY registration_date ASC";
    $result = mysqli_query($dbc, $query);

    // Count the number of returned rows
    $num = mysqli_num_rows($result);
	
	echo '<div class="meetings_section layout_padding">
    <div class="container">
        <div class="meetings_section_2">
            <div class="row">';
	
    if ($num > 0) { // If there are registered users
        // Print the number of registered users
        echo "<p>There are currently $num registered users.</p>\n";

        // Table header
        echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
            <tr>
                <td align="left"><b>Edit</b></td>
                <td align="left"><b>Delete</b></td>
                <td align="left"><b>Student ID</b></td>
                <td align="left"><b>Name</b></td>
                <td align="left"><b>Email</b></td>
                <td align="left"><b>Position</b></td>
                <td align="left"><b>Registration Date</b></td>
            </tr>';

        // Fetch and print all the records
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
                <td align="left"><a href="edit-member.php?id=' . $row['member_id'] . '">Edit</a></td>
                <td align="left"><a href="delete-member.php?id=' . $row['member_id'] . '">Delete</a></td>
                <td align="left">' . $row['student_id'] . '</td>
                <td align="left">' . $row['name'] . '</td>
                <td align="left">' . $row['email'] . '</td>
                <td align="left">' . $row['position'] . '</td>
                <td align="left">' . $row['registration_date'] . '</td>
            </tr>';
        }

        echo '</table>';
        mysqli_free_result($result); // Free memory associated with the result
    } else {
        // If no records were returned
        echo '<p class="error">There are currently no registered users.</p>';
    }
	echo '</div></div></div></div>';
?>

<!-- footer section -->
<?php
    include('../includes/admin-footer.html');
?>
<!-- footer section end -->
</body>
</html>

<!-- Javascript files -->
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

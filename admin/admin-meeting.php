<!-- header section -->
<?php
    $page_title = 'Meeting Management';
    include ('../includes/admin-header.html');
?>

<!-- meetings section start -->
<div class="meetings_section layout_padding">
    <div class="container">
        <div class="meetings_section_2">
            <div class="row">
                <?php
                    // Make the query:
                    $meetings_query = "SELECT * FROM meetings";
                    
                    $result = mysqli_query($dbc, $meetings_query); // Run the query.
                    
                    // Count the number of returned rows:
                    $num = mysqli_num_rows($result);
                    
                    if ($num > 0) { // If it ran OK, display the records.

                    // Print how many meetings there are:
                    echo "<p>There are currently $num scheduled meetings.</p>\n";

                    // Table header:
                    echo '<table align="center" cellspacing="10" cellpadding="3" width="100%">
                    <tr>
                        <td align="left"><b>Edit</b></td>
                        <td align="left"><b>Delete</b></td>
                        <td align="left"><b>Topic</b></td>
                        <td align="left"><b>Description</b></td>
                        <td align="left"><b>Date</b></td>
                        <td align="left"><b>Time</b></td>
                        <td align="left"><b>Location</b></td>
                    </tr>
                ';
                    
                    // Fetch and print all the records:
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo '<tr>
                            <td align="left"><a href="edit-meeting.php?id=' . $row['meeting_id'] . '">Edit</a></td>
                            <td align="left"><a href="delete-meeting.php?id=' . $row['meeting_id'] . '">Delete</a></td>
                            <td align="left">' . $row['topic'] . '</td>
                            <td align="left">' . $row['description'] . '</td>
                            <td align="left">' . $row['date'] . '</td>
                            <td align="left">' . $row['time'] . '</td>
                            <td align="left">' . $row['location'] . '</td>
                        </tr>
                        ';
                    }

                    echo '</table>';

                    mysqli_free_result ($result); // Free memory associated with $r    

                    } else { // If no records were returned.
                        echo '<p class="error">There are currently no scheduled meetings.</p>';
                    }
                ?>
                <!-- Retained lines -->
            </div>
			<!-- Schedule a meeting button -->
			<div style="text-align: right; margin-top: 15px; margin-right: 100px;">
				<a href="add-meeting.php" class="manipulate-btn">Schedule a Meeting</a>
			</div>
        </div>
    </div>
</div>
<!-- meetings section end -->


  
<!-- footer section -->
<?php
    include ('../includes/admin-footer.html');
?>
<!-- footer section end -->
</body>
</html>
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

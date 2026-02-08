<!-- header section -->
<?php
    $page_title = 'Announcement';
    include ('../includes/admin-header.html');
?>

<!-- news section start -->
<div class="news_section layout_padding">
    <div class="container">
        <div class="news_section_2">
            <div class="row">
                <?php

                    // Make the query:
                    $activities_query = "SELECT * FROM activities";
                    
                    $result = mysqli_query($dbc, $activities_query); // Run the query.
                    
                    // Count the number of returned rows:
                    $num = mysqli_num_rows($result);
                    
                    if ($num > 0) { // If it ran OK, display the records.

                        // Print how many activities there are:
                        echo "<p>There are currently $num registered activities.</p>\n";

                        // Table header:
                        echo '<table align="center" cellspacing="3" cellpadding="3" width="90%">
                        <tr>
                            <td align="left"><b>Edit</b></td>
                            <td align="left"><b>Delete</b></td>
                            <td align="left"><b>Title</b></td>
                            <td align="left"><b>Description</b></td>
                            <td align="left"><b>Date</b></td>
                            <td align="left"><b>Time</b></td>
                            <td align="left"><b>Location</b></td>
                        </tr>
                    ';
                    
                    // Fetch and print all the records:
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo '<tr>
                            <td align="left"><a href="edit-news.php?id=' . $row['activity_id'] . '">Edit</a></td>
                            <td align="left"><a href="delete-news.php?id=' . $row['activity_id'] . '">Delete</a></td>
                            <td align="left">' . $row['title'] . '</td>
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
                        echo '<p class="error">There are currently no registered users.</p>';
                    }
                ?>
            </div>
			<div style="text-align: right; margin-top: 15px; margin-right: 100px;">
				<a href="add-news.php" class="manipulate-btn">Add new activity</a>
			</div>
        </div>     
    </div>
</div>
  
<!-- news section end -->

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

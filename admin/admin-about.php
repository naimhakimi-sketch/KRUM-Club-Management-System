<!-- header section start -->
<?php
    $page_title = 'Admin About';
    include ('../includes/admin-header.html');
    
    // Make the query:
    $about_qu = "SELECT * FROM about";
    
    $raqu = mysqli_query($dbc, $about_qu); // Run the query.

    // Fetch the data and close the database connection
    $row_about = mysqli_fetch_array($raqu, MYSQLI_ASSOC);

    // Check if data was fetched successfully
    if($row_about) {
        echo '<!-- about section start -->';
        echo '<div class="about_section layout_padding">';
        echo '<div class="container-fluid">';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<div class="about_taital_main">';
        echo "<h1 class=\"about_taital\">{$row_about['title']}<br></h1>";
        echo '<p class="about_text">' . $row_about['description'] . '</p>';
		 echo '<div class="readmore_bt"><a href="edit-about.php?id=' . $row_about['about_id'] . '">Edit</a></div>';
        echo '<div class="readmore_bt"><a href="admin-readmore.php">Read More</a></div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-6 padding_right_0">';
        echo '<div><img src="../images/about-img-2.png" class="about_img"></div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<!-- about section end -->';
    } else {
        echo 'Error fetching data.';
    }
?>
<!-- footer section start -->
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
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

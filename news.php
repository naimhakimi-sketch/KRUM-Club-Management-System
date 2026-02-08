<!-- header section -->
<?php
    $page_title = 'Announcement';
    include ('includes/header.html');
?>

<!-- news section start -->
<div class="news_section layout_padding">
    <div class="container">
        <div>
            <h1 class="about_taital">Perkembangan Aktiviti</h1>
            <p>Ikuti perkembangan terkini dan acara menarik di KRUM (Kelab Rekreasi UniKL MIIT) melalui bahagian berita kami. Daripada pengembaraan yang akan datang kepada pengumuman penting, ini adalah sumber utama anda untuk semua perkara yang berkaitan dengan luar!</p>
        </div>
        <div class="news_section_2">
            <div class="row">
                <?php
                    // Make the query:
                    $activities_query = "SELECT * FROM activities";
                    
                    $result = mysqli_query($dbc, $activities_query); // Run the query.

                    // Fetch and display activities
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo '<div class="col-md-4">';
                            echo '<div><h2>' . $row['title'] . '</h2>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '<p><strong>Date:</strong> ' . $row['date'] . '</p>';
                            echo '<p><strong>Time:</strong> ' . $row['time'] . '</p>';
                            echo '<p><strong>Location:</strong> ' . $row['location'] . '</p></div>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No activities found.';
                    }				
                ?>
				<img src="images/run.png" class="marathon_img">
            </div>
        </div>
    </div>
</div>
<!-- news section end -->

<!-- footer section -->
<?php
    include ('includes/footer.html');
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

<!-- header section -->
<?php
    $page_title = 'Meeting';
    include ('includes/header.html');
?>

<!-- meeting section start -->
<div class="meeting_section layout_padding">
    <div class="container">
        <h1 class="about_taital">Perjumpaan </h1>
        <p class="meeting_text">Pertemuan kami adalah nadi KRUM, di mana ahli berkumpul untuk merancang pengembaraan, berkongsi pengalaman dan mengukuhkan komuniti kami. Sama ada anda ahli baharu atau peminat luar yang berpengalaman, mesyuarat kami menawarkan peluang yang baik untuk berhubung, belajar dan terlibat dalam aktiviti menarik kami.</p>
        <div class="meeting_section_2">
            <div class="row">
                <?php
                    // Make the query:
                    $meeting_query = "SELECT * FROM meetings";
                    
                    $result = mysqli_query($dbc, $meeting_query); // Run the query.

                    // Fetch and display meetings
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo '<div class="col-md-4">';
                            echo '<div><h2>' . $row['topic'] . '</h2>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '<p><strong>Date:</strong> ' . $row['date'] . '</p>';
                            echo '<p><strong>Time:</strong> ' . $row['time'] . '</p>';
                            echo '<p><strong>Location:</strong> ' . $row['location'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No meetings found.';
                    }
                ?>
				<img src="images/meeting.png" class="meeting_img" alt="Meeting Image">
            </div>
        </div>
    </div>
</div>
<!-- meeting section end -->

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

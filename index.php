<?php 
// Connect to the database
require ('../mysqli_connect_krum.php'); // Adjust the path as necessary

# login_handle.php
// This script performs a SELECT query to verify login from the members table.

// Initialize an error array.
$errors = array(); 

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = trim($_POST['email']);
    }

    // Check for a password:
    if (!empty($_POST['pass1'])) {
        $p = trim($_POST['pass1']);
    } else {
        $errors[] = 'You forgot to enter your password.';
    }
	
	if (isset($_POST['logintype'])) {
        $login_t = trim($_POST['logintype']);
    } else {
        $errors[] = 'You forgot to choose login type.';
    }

    if (empty($errors)) { // If everything's OK.
		if($login_t == "member"){
			// Make the query:
			$q = "SELECT email, password FROM members WHERE email = '$e' AND password = SHA1('$p')";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));

			if (mysqli_num_rows($r) == 1) { // If the query ran OK and returned one result
				// If the email and password are correct
				header("Location: about.php");
				exit();
			} else {
				$errors[] = 'Your email or password is wrong!';
			}
		}
		else{
			// Make the query:
			$q = "SELECT email, password FROM committees WHERE email = '$e' AND password = SHA1('$p')";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));

			if (mysqli_num_rows($r) == 1) { // If the query ran OK and returned one result
				// If the email and password are correct
				header("Location: admin/admin-about.php");
				exit();
			} else {
				$errors[] = 'Your email or password is wrong!';
			}
		}
		
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Announcement</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
    <!-- owl stylesheets --> 
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!-- style css -->
    <style>
        /* Add your CSS styles here */
         .login_form {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            max-width: 400px; /* Adjust maximum width as needed */
            margin-left: auto;
            margin-right: auto;
            backdrop-filter: blur(10px); /* Blur effect */
        }
        .login_form input[type="text"],
        .login_form input[type="password"] {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            color: #fff;
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
            max-width: 350px; /* Adjust maximum width as needed */
            outline: none;
        }
        .login_form input[type="submit"] {
            background-color: #2f4f4f;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            max-width: 350px; /* Adjust maximum width as needed */
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            transition-duration: 0.4s;
        }
        .login_form input[type="submit"]:hover {
            background-color: #122c2d;
        }
		.header_section {
            position: relative;
            z-index: 1000;
        }
        .header_main {
            position: relative;
            z-index: 1001;
        }
		a{
			color: #fff;
			text-decoration: underline;
		}
		.error{
			color: red;
		}
    </style>
</head>
<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="header_main_index">
            <div class="container-fluid">
                <div class="logo"><a href="index.php"><img src="images/unikl-logo.png" alt="logo"><img src="images/krum-logo.png" alt="logo"></a></div>
            </div>
        </div>
         <!-- banner section start -->
         <div class="banner_section layout_padding">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <h1 class="banner_taital">Kelab Rekreasi UniKL MIIT</h1>
                        <p class="banner_text">Kelab Rekreasi UniKL MIIT merupakan sebuah medium untuk mahasiswa UniKL MIIT bergiat aktif dalam dunia rekreasi. <br/><br/>"Perkongsian Bersama , Terus Mengembara"</p>
                     </div>
                  </div>
               </div>
            </div>
            <!-- login form -->
            <form action="index.php" method="post" class="login_form">
                <h1 style="color: white;" class="register_taital">Selamat Datang</h1>
                <div class="email_text">
                    <p style="color: white;">Email Address: <input type="text" name="email" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /></p>
                    <p style="color: white;">Password: <input type="password" name="pass1" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
                    <input type="radio" name="logintype" value="member">
                    <span style="color: white;">Log In as member</span><br>
                    <input type="radio" name="logintype" value="committee">
                    <span style="color: white;">Log In as committee</span><br>

                    <?php 
                    // Display the errors if there are any
                    if (!empty($errors)) {
                        echo '<div class="error">';
                        foreach ($errors as $msg) {
                            echo " - $msg<br />\n";
                        }
                        echo '</div>';
                    }
                    ?>

                    <p><input type="submit" name="login" value="Log In" /></p>
                    <div><p style="color: white;">Want to join as a new member? <a href="register.php">REGISTER HERE</a></p></div>
                </div>
            </form>
            <!-- login form end -->
         </div>
         <!-- banner section end -->
      </div>
      
      <?php
        include ('includes/index-footer.html');
      ?>
</body>
</html>
<!-- Javascript files-->

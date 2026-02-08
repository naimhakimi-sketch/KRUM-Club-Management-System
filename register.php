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
    <title>Register</title>
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
            background-color: #4CAF50;
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
            background-color: #45a049;
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
			text-decoration-color: black;
		}
		.error{
			color: red;
		}
		#back{
			color: black;
		}
		#back:hover {
			color: blue;
		}
    </style>
</head>
<body>
	<div class="header_section">
		<div class="header_main_index">
			<div class="container-fluid">
				<div class="logo"><a href="index.php"><img src="images/unikl-logo.png" alt="logo"><img src="images/krum-logo.png" alt="logo"></a></div>
			</div>
		</div>
	</div>
<?php
	
    // Include database connection
    require_once('../mysqli_connect_krum.php');

    $page_title = 'Register';

    // Check for form submission:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array(); // Initialize an error array.

        // Check for name:
        if (empty($_POST['name'])) {
            $errors[] = 'You forgot to enter your name.';
        } else {
            $n = trim($_POST['name']);
        }

        // Check for student id:
        if (empty($_POST['student_id'])) {
            $errors[] = 'You forgot to enter your student id.';
        } else {
            $s_id = trim($_POST['student_id']);
        }

        // Check for an email address:
        if (empty($_POST['email'])) {
            $errors[] = 'You forgot to enter your email address.';
        } else {
            $e = trim($_POST['email']);
        }

        if (isset($_POST['programme'])) {
            $prog = $_POST['programme'];
        } else {
            $errors[] = 'You forgot to choose programme.';
        }

        // Check for a password and match against the confirmed password:
        if (!empty($_POST['pass1'])) {
            if ($_POST['pass1'] != $_POST['pass2']) {
                $errors[] = 'Your password did not match the confirmed password.';
            } else {
                $p = trim($_POST['pass1']);
            }
        } else {
            $errors[] = 'You forgot to enter your password.';
        }

        if (empty($errors)) { // If everything's OK.

            // Check if email is already registered
            $check_email_query = "SELECT * FROM members WHERE email='$e'";
            $check_email_result = mysqli_query($dbc, $check_email_query);
            if (mysqli_num_rows($check_email_result) > 0) {
                // Email already exists, display error message
                echo 'Email is already registered. Please use another email.';
            } else {
                // Email is not registered, proceed with registration

                // Register the user in the database...

                // Make the query:
                $q = "INSERT INTO members (name, student_id, email, programme, position, password, registration_date) VALUES ('$n', '$s_id', '$e', '$prog', 'Regular Member', SHA1('$p'), NOW())";

                $r = mysqli_query($dbc, $q); // Run the query.
                if ($r) { // If it ran OK.
                    // Print a success message:
                    echo '<h1>Thank you!</h1>
                    <p>You are now registered! <a href="index.php" id="back">Back to login page</a></p><p><br /></p>';
                } else { // If it did not run OK.
                    // Public message:
                    echo '<h1>System Error</h1>
                    <p class="error">You could not be registered due to a system error. We apologize for any inconvenience. <a href="index.php" id="back">Back to login page</a></p>';
                    // Debugging message:
                    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
                } // End of if ($r) IF.
            }

        } else { // Report the errors.
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) { // Print each error.
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /><a href="index.php" id="back">Back to login page</a></p>';
        } // End of if (empty($errors)) IF.
    } // End of the main Submit conditional.
?>

<!-- header section end -->

<!-- register section start -->
<div class="register_section layout_padding">
    <div class="container">
        <form action="register.php" method="post">
            <h1 class="register_taital">Let's Register as a KRUM Member!!</h1>
            <div class="email_text">
                <p>Name: <input type="text" name="name" size="15" maxlength="40"
                        value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></p>
                <p>Student ID: <input type="text" name="student_id" size="15" maxlength="11"
                        value="<?php if (isset($_POST['student_id'])) echo $_POST['student_id']; ?>" /></p>
                <p>Email Address: <input type="email" name="email" size="20" maxlength="40"
                        value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /> </p>
                <p><b>Programme:</b>
                    <?php
                    // This script make a pull-down menus for an HTML form: programme.
                    // The programmes is display in an array.
                    $programme = array('BNS', 'BCS', 'BSE', 'BIOT', 'BCSS', 'BIMD', 'BCA', 'BCEM');
                    // the programmes is display using the pull-down menu.
                    echo '<select name="programme">';
                    foreach ($programme as $key => $value) {
                        echo "<option value=\"$value\">$value</option>\n";
                    }
                    echo '</select>';
                    ?>
                </p>
                <p>Password: <input type="password" name="pass1" size="10" maxlength="20"
                        value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" /></p>
                <p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20"
                        value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" /></p>
                <p><input type="submit" name="submit" value="Register" /></p>
				<p><a href="index.php" id = "back"> Back to Login page </a></p>
            </div>
        </form>
    </div>
</div>
<!-- register section end -->

<!-- footer section start -->
<?php
include('includes/footer.html');
?>
<!-- footer section end -->
</body>
</html>
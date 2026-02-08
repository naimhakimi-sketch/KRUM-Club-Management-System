<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- site metas -->
    <title><?php echo $page_title; ?></title> 
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
    <!-- owl stylesheets --> 
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        .container {
            width: 80%; /* Set the width of the container */
            margin: 0 auto; /* Center the container horizontally */
        }
        .header_section {
            position: relative;
            z-index: 1000;
        }
        .header_main {
            position: relative;
            z-index: 1001;
        }
    </style>
</head>
<body>
<?php
$page_title = 'Admin';
include ('../includes/admin-header.html');

require ('../../../mysqli_connect_krum.php'); // Connect to the db.

// Check for update contact form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["update_contact"])) {

    $errors = array(); // Initialize an error array.

    // Check for title:
    if (empty($_POST['contact_phone'])) {
        $errors[] = 'You need to enter new phone number';
    } else {
        $contact_phone = trim($_POST['contact_phone']);
    }

    // Check for description:
    if (empty($_POST['contact_email'])) {
        $errors[] = 'You need to enter new KRUM email address';
    } else {
        $contact_email = trim($_POST['contact_email']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $contact_query = "UPDATE club_contact SET phone = '$contact_phone', email = '$contact_email' WHERE contact_id = 1";
        
        $rcq = mysqli_query($dbc, $contact_query); // Run the contact query.
        if ($rcq) { // If it ran OK.

            // Print a message:
            echo '<h1>Club contact information updated successfully!</h1><p><br /></p>';    

        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Club information update failed, please try again. We apologize for any inconvenience.</p>'; 

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $contact_query . '</p>';

        }

    } else { // Report the errors.

        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

} // End of the update_contact conditional.

// Check for add meeting form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["add_meeting"])) {

    $errors = array(); // Initialize an error array.

    // Check for topic:
    if (empty($_POST['meeting_topic'])) {
        $errors[] = 'You need to enter the meeting topic';
    } else {
        $meeting_topic = trim($_POST['meeting_topic']);
    }

    // Check for description:
    if (empty($_POST['meeting_description'])) {
        $errors[] = 'You need to enter the meeting description';
    } else {
        $meeting_description = trim($_POST['meeting_description']);
    }

    // Check for date:
    if (empty($_POST['meeting_date'])) {
        $errors[] = 'You need to enter the meeting date';
    } else {
        $meeting_date = $_POST['meeting_date'];
    }

    // Check for time:
    if (empty($_POST['meeting_time'])) {
        $errors[] = 'You need to enter the meeting time';
    } else {
        $meeting_time = $_POST['meeting_time'];
    }

    // Check for location:
    if (empty($_POST['meeting_location'])) {
        $errors[] = 'You need to enter the meeting location';
    } else {
        $meeting_location = trim($_POST['meeting_location']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $meeting_query = "INSERT INTO meetings (topic, description, date, time, location) VALUES ('$meeting_topic', '$meeting_description', '$meeting_date', '$meeting_time', '$meeting_location')";
        
        $rmq = mysqli_query($dbc, $meeting_query); // Run the meeting query.
        if ($rmq) { // If it ran OK.

            // Print a message:
            echo '<h1>Meeting information added successfully!</h1><p><br /></p>';    

        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Meeting information addition failed, please try again. We apologize for any inconvenience.</p>'; 

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $meeting_query . '</p>';

        }

    } else { // Report the errors.

        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

} // End of the add_meeting conditional.

// Check for delete meeting form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["delete_meeting"])) {

    $errors = array(); // Initialize an error array.

    // Check for email:
    if (empty($_POST['meeting_id'])) {
        $errors[] = 'You need to enter meeting id';
    } else {
        $meeting_id = trim($_POST['meeting_id']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $delete_mquery = "DELETE FROM meetings WHERE meeting_id = '$meeting_id'";
        
        $rdmq = mysqli_query($dbc, $delete_mquery); // Run the delete query.
        if ($rdmq) { // If it ran OK.

            // Print a message:
            echo '<h1>Meeting deleted successfully!</h1><p><br /></p>';    

        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Meeting deletion failed, please try again. We apologize for any inconvenience.</p>'; 

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $delete_mquery . '</p>';

        }

    } else { // Report the errors.

        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

} // End of the delete meeting conditional.

// Check for add activity form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["add_activity"])) {

    $errors = array(); // Initialize an error array.

    // Check for title:
    if (empty($_POST['activity_title'])) {
        $errors[] = 'You need to enter the activity title';
    } else {
        $activity_title = trim($_POST['activity_title']);
    }

    // Check for description:
    if (empty($_POST['activity_description'])) {
        $errors[] = 'You need to enter the activity description';
    } else {
        $activity_description = trim($_POST['activity_description']);
    }

    // Check for date:
    if (empty($_POST['activity_date'])) {
        $errors[] = 'You need to enter the activity date';
    } else {
        $activity_date = $_POST['activity_date'];
    }

    // Check for time:
    if (empty($_POST['activity_time'])) {
        $errors[] = 'You need to enter the activity time';
    } else {
        $activity_time = $_POST['activity_time'];
    }

    // Check for location:
    if (empty($_POST['activity_location'])) {
        $errors[] = 'You need to enter the activity location';
    } else {
        $activity_location = trim($_POST['activity_location']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $activity_query = "INSERT INTO activities (title, description, date, time, location) VALUES ('$activity_title', '$activity_description', '$activity_date', '$activity_time', '$activity_location')";
        
        $racq = mysqli_query($dbc, $activity_query); // Run the activity query.
        if ($racq) { // If it ran OK.

            // Print a message:
            echo '<h1>Activity information added successfully!</h1><p><br /></p>';    

        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Activity information addition failed, please try again. We apologize for any inconvenience.</p>'; 

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $activity_query . '</p>';

        }

    } else { // Report the errors.

        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

} // End of the add_activity conditional.

// Check for delete activity form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["delete_activity"])) {

    $errors = array(); // Initialize an error array.

    // Check for email:
    if (empty($_POST['activity_id'])) {
        $errors[] = 'You need to enter activity id';
    } else {
        $activity_id = trim($_POST['activity_id']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $delete_aquery = "DELETE FROM activities WHERE activity_id = '$activity_id'";
        
        $rdaq = mysqli_query($dbc, $delete_aquery); // Run the delete query.
        if ($rdaq) { // If it ran OK.

            // Print a message:
            echo '<h1>Activity deleted successfully!</h1><p><br /></p>';    

        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Activity deletion failed, please try again. We apologize for any inconvenience.</p>'; 

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $delete_aquery . '</p>';

        }

    } else { // Report the errors.

        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

} // End of the delete activity conditional.


// Check for remove member form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["remove_member"])) {

    $errors = array(); // Initialize an error array.

    // Check for email:
    if (empty($_POST['delete_email'])) {
        $errors[] = 'You need to enter the email address';
    } else {
        $delete_email = trim($_POST['delete_email']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $delete_query = "DELETE FROM members WHERE email = '$delete_email'";
        
        $rdq = mysqli_query($dbc, $delete_query); // Run the delete query.
        if ($rdq) { // If it ran OK.

            // Print a message:
            echo '<h1>Member removed successfully!</h1><p><br /></p>';    

        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Member removal failed, please try again. We apologize for any inconvenience.</p>'; 

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $delete_query . '</p>';

        }

    } else { // Report the errors.

        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

} // End of the remove_member conditional.
?>



    <!-- header section end -->
	
	<h1>KRUM Admin Page</h1>
	
	<!-- update club information: contact -->
	<div>
		<h2>Contact</h2>
		<form action="admin.php" method="post">
			<p>Phone:<br> <input type="text" name="contact_phone" size="15" maxlength="12" value="<?php if (isset($_POST['contact_phone'])) echo $_POST['contact_phone']; ?>" /></p>
			<p>Email address:<br> <input type="email" name="contact_email" size="15" maxlength="40" value="<?php if (isset($_POST['contact_email'])) echo $_POST['contact_email']; ?>" /></p>
			<p><br/><input type="submit" name="update_contact" value="Update" /></p>
		</form>
	</div>
	
	<!-- Add meeting information -->
	<div>
		<h2>Meeting</h2>
		<?php
                    // Make the query:
                    $meeting_query = "SELECT * FROM meetings";
                    
                    $result = mysqli_query($dbc, $meeting_query); // Run the query.

                    // Fetch and display meetings
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<div><h3>' . 'Meeting ID: ' . $row['meeting_id'] . '    |    ' . 'Meeting Topic: ' . $row['topic'] . '</h3>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '<p><strong>Date:</strong> ' . $row['date'] . '</p>';
                            echo '<p><strong>Time:</strong> ' . $row['time'] . '</p>';
                            echo '<p><strong>Location:</strong> ' . $row['location'] . '</p></div>';
                            echo '</div>';
                        }
                    } else {
                        echo 'No meetings found.';
                    }

        ?>
		<h3>Add new meeting</h3>
		<form action="admin.php" method="post">
			<p>Topic:<br> <input type="text" name="meeting_topic" size="15" maxlength="40" value="<?php if (isset($_POST['meeting_topic'])) echo $_POST['meeting_topic']; ?>" /></p>
			<p>Description<br> <input type="text" name="meeting_description" size="15" maxlength="1000" value="<?php if (isset($_POST['meeting_description'])) echo $_POST['meeting_description']; ?>" /></p>
			<p>Date:<input type="date" name="meeting_date" size="15" value="<?php if (isset($_POST['meeting_date'])) echo $_POST['meeting_date']; ?>" />
			Time:<input type="time" name="meeting_time" size="15" value="<?php if (isset($_POST['meeting_timea'])) echo $_POST['meeting_time']; ?>" /></p>
			<p>Location:<br> <input type="text" name="meeting_location" size="15" maxlength="40" value="" /></p>
			<p><br/><input type="submit" name="add_meeting" value="Add" /></p>
		</form>
		<h3>Delete meeting by entering meeting id</h3>
		<form action="admin.php" method="post">
			<p>ID:<br> <input type="number" name="meeting_id" size="15" maxlength="40" value="<?php if (isset($_POST['meeting_id'])) echo $_POST['meeting_id']; ?>" /></p>
			<p><br/><input type="submit" name="delete_meeting" value="Delete" /></p>
		</form>
	
	
	<!-- Add activity or event information -->
	<div>
		<h2>Activity</h2>
		<?php
			// Make the query:
			$activities_query = "SELECT * FROM activities";
						
			$result = mysqli_query($dbc, $activities_query); // Run the query.

			// Fetch and display activities
			if(mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
                    echo '<div><h3>' . 'Activity ID: ' . $row['activity_id'] . '    |    ' . 'Activity Name: ' . $row['title'] . '</h3>';
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
		<h3>Add new activity</h3>
		<form action="admin.php" method="post">
			<p>Title:<br> <input type="text" name="activity_title" size="15" maxlength="40" value="<?php if (isset($_POST['activity_title'])) echo $_POST['activity_title']; ?>" /></p>
			<p>Description<br> <input type="text" name="activity_description" size="15" maxlength="1000" value="<?php if (isset($_POST['activity_description'])) echo $_POST['activity_description']; ?>" /></p>
			<p>Date:<input type="date" name="activity_date" size="15" value="<?php if (isset($_POST['activity_date'])) echo $_POST['activity_date']; ?>" />
			Time:<input type="time" name="activity_time" size="15" value="<?php if (isset($_POST['activity_time'])) echo $_POST['activity_time']; ?>" /></p>
			<p>Location:<br> <input type="text" name="activity_location" size="15" maxlength="40" value="" /></p>
			<p><br/><input type="submit" name="add_activity" value="Add" /></p>
		</form>
		<h3>Delete activity by entering activity id</h3>
		<form action="admin.php" method="post">
			<p>ID:<br> <input type="number" name="activity_id" size="15" maxlength="40" value="<?php if (isset($_POST['activity_id'])) echo $_POST['activity_id']; ?>" /></p>
			<p><br/><input type="submit" name="delete_activity" value="Delete" /></p>
		</form>
	</div>
	
	<!-- delete member -->
	<div>
		<h2>Manage Member</h2>
		<?php
		// Fetch member data from the database
		$query = "SELECT student_id, name, registration_date, email FROM members";
		$result = mysqli_query($dbc, $query);

		// Check if query was successful
		if ($result) {
			echo '
			<h3>Member List</h3>
			<table border="1">
				<thead>
					<tr>
						<th>Email Address</th>
						<th>Student ID</th>
						<th>Name</th>
						<th>Registration Date</th>
					</tr>
				</thead>
				<tbody>';

			// Loop through the fetched data and display it in the table
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td>' . $row['email'] . '</td>';
				echo '<td>' . $row['student_id'] . '</td>';
				echo '<td>' . $row['name'] . '</td>';
				echo '<td>' . $row['registration_date'] . '</td>';
				echo '</tr>';
			}

			echo '</tbody>
			</table>';

			// Free result set
			mysqli_free_result($result);
		} else {
			echo '<p>Error retrieving member data from the database!</p>';
		}
		?>
		<p>Enter e-mail address of a member to remove a member from the KRUM club</p>
		<form action="admin.php" method="post">
			<p>Email:<br> <input type="email" name="delete_email" size="15" maxlength="40" value="<?php if (isset($_POST['delete_email'])) echo $_POST['delete_email']; ?>" /></p>
			<p><br/><input type="submit" name="remove_member" value="remove" /></p>
		</form>
	</div>
	<?php
    include ('../includes/admin-footer.html');
	?>
</body>
</html>
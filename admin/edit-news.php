<?php

// This page is for editing a activities record.
// This page is accessed through admin-news.php.

$page_title = 'Edit activities';
include ('../includes/admin-header.html');
echo '<h1> Edit activities </h1>';

// Check for a valid about ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From admin-members.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('../includes/admin-footer.html'); 
	exit();
}

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); // Collect error message
	
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
	
		//  Test for unique email address:
		$q = "SELECT activity_id FROM activities WHERE activity_id!= $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE activities SET title='$activity_title', description='$activity_description', date='$activity_date', time='$activity_time', location='$activity_location' WHERE activity_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>Activity has been edited.</p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">Club information could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { 
		}
		
	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the activity's information:
$q = "SELECT title, description, date, time, location FROM activities WHERE activity_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid activity ID, show the form.

	// Get the activity's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form action="edit-news.php" method="post">
<p>Title: <input type="text" name="activity_title" size="15" maxlength="40" value="' . $row[0] . '" /></p>
<p>Description: <input type="text" name="activity_description" size="15" maxlength="1000" value="' . $row[1] . '" /></p>
<p>Date: <input type="date" name="activity_date" size="15" maxlength="15" value="' . $row[2] . '" /></p>
<p>Time: <input type="time" name="activity_time" size="15" maxlength="15" value="' . $row[3] . '" /></p>
<p>location: <input type="text" name="activity_location" size="40" maxlength="40" value="' . $row[4] . '" /></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}
		
    include ('../includes/admin-footer.html');
?>

</body>
</html>
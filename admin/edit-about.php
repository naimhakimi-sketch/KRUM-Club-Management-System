<?php

// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'Edit Club Information';
include ('../includes/admin-header.html');
echo '<h1> Edit club information </h1>';

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
    if (empty($_POST['about_title'])) {
        $errors[] = 'You need to enter the title of club Information';
    } else {
        $about_title = trim($_POST['about_title']);
    }

    // Check for description:
    if (empty($_POST['about_description'])) {
        $errors[] = 'You need to enter description';
    } else {
        $about_description = trim($_POST['about_description']);
    }

	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique id:
		$q = "SELECT about_id FROM about WHERE about_id!= $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE about SET title='$about_title', description='$about_description' WHERE about_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>Club information has been edited.</p>';	
				
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

// Retrieve the user's information:
$q = "SELECT title, description FROM about WHERE about_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form action="edit-about.php" method="post">
<p>Title: <input type="text" name="about_title" size="15" maxlength="40" value="' . $row[0] . '" /></p>
<p>Description: <input type="text" name="about_description" size="15" maxlength="1000" value="' . $row[1] . '" /></p>
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
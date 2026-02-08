<?php

// This page is for editing contact information.
// This page is accessed through view_users.php.

$page_title = 'Edit Contact Information';
include ('../includes/admin-header.html');
echo '<h1>Edit Contact Information</h1>';

// Check for a valid contact ID, through GET or POST:
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From view_users.php
    $id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form submission.
    $id = $_POST['id'];
} else { // No valid ID, kill the script.
    echo '<p class="error">This page has been accessed in error.</p>';
    include ('../includes/admin-footer.html');
    exit();
}

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Collect error messages

    // Check for phone:
    if (empty($_POST['phone'])) {
        $errors[] = 'You need to enter the phone number';
    } else {
        $phone = trim($_POST['phone']);
    }

    // Check for email:
    if (empty($_POST['email'])) {
        $errors[] = 'You need to enter the email address';
    } else {
        $email = trim($_POST['email']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $q = "UPDATE club_contact SET phone='$phone', email='$email' WHERE contact_id=$id LIMIT 1";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

            // Print a message:
            echo '<p>Contact information has been edited.</p>';

        } else { // If it did not run OK.
            echo '<p class="error">Contact information could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
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

// Retrieve the contact information:
$q = "SELECT phone, email FROM club_contact WHERE contact_id=$id";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid contact ID, show the form.

    // Get the contact's information:
    $row = mysqli_fetch_array($r, MYSQLI_NUM);

    // Create the form:
    echo '<form action="edit-contact.php" method="post">
<p>Phone: <input type="text" name="phone" size="15" maxlength="20" value="' . $row[0] . '" /></p>
<p>Email: <input type="text" name="email" size="30" maxlength="60" value="' . $row[1] . '" /></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid contact ID.
    echo '<p class="error">This page has been accessed in error.</p>';
}

include ('../includes/admin-footer.html');
?>

</body>
</html>

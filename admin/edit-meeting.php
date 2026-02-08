<html>
<body>
<?php

// This page is for editing a meeting record.
// This page is accessed through admin-meeting.php.

$page_title = 'Edit Meeting';
include ('../includes/admin-header.html');
echo '<h1>Edit Meeting</h1>';

// Check for a valid meeting ID, through GET or POST:
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From admin-meeting.php
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

    // Check for topic:
    if (empty($_POST['meeting_topic'])) {
        $errors[] = 'You need to enter the meeting topic.';
    } else {
        $meeting_topic = trim($_POST['meeting_topic']);
    }

    // Check for description:
    if (empty($_POST['meeting_description'])) {
        $errors[] = 'You need to enter the meeting description.';
    } else {
        $meeting_description = trim($_POST['meeting_description']);
    }

    // Check for date:
    if (empty($_POST['meeting_date'])) {
        $errors[] = 'You need to enter the meeting date.';
    } else {
        $meeting_date = $_POST['meeting_date'];
    }

    // Check for time:
    if (empty($_POST['meeting_time'])) {
        $errors[] = 'You need to enter the meeting time.';
    } else {
        $meeting_time = $_POST['meeting_time'];
    }

    // Check for location:
    if (empty($_POST['meeting_location'])) {
        $errors[] = 'You need to enter the meeting location.';
    } else {
        $meeting_location = trim($_POST['meeting_location']);
    }

    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $q = "UPDATE meetings SET topic='$meeting_topic', description='$meeting_description', date='$meeting_date', time='$meeting_time', location='$meeting_location' WHERE meeting_id=$id LIMIT 1";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

            // Print a message:
            echo '<p>The meeting has been edited.</p>';

        } else { // If it did not run OK.
            echo '<p class="error">The meeting could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
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

// Retrieve the meeting's information:
$q = "SELECT topic, description, date, time, location FROM meetings WHERE meeting_id=$id";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid meeting ID, show the form.

    // Get the meeting's information:
    $row = mysqli_fetch_array($r, MYSQLI_NUM);

    // Create the form:
    echo '<form action="edit-meeting.php" method="post">
<p>Topic: <input type="text" name="meeting_topic" size="15" maxlength="40" value="' . $row[0] . '" /></p>
<p>Description: <input type="text" name="meeting_description" size="15" maxlength="1000" value="' . $row[1] . '" /></p>
<p>Date: <input type="date" name="meeting_date" size="15" maxlength="15" value="' . $row[2] . '" /></p>
<p>Time: <input type="time" name="meeting_time" size="15" maxlength="15" value="' . $row[3] . '" /></p>
<p>Location: <input type="text" name="meeting_location" size="40" maxlength="40" value="' . $row[4] . '" /></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid meeting ID.
    echo '<p class="error">This page has been accessed in error.</p>';
}

include ('../includes/admin-footer.html');
?>

</body>
</html>

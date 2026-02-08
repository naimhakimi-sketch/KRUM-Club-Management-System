<?php 
// This script performs an INSERT query to add a record to the activities table.

$page_title = 'Add Activity';
include ('../includes/admin-header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.
    
    // Check for an activity title:
    if (empty($_POST['title'])) {
        $errors[] = 'You forgot to enter the activity title.';
    } else {
        $title = trim($_POST['title']);
    }
    
    // Check for a description:
    if (empty($_POST['description'])) {
        $errors[] = 'You forgot to enter the activity description.';
    } else {
        $description = trim($_POST['description']);
    }

    // Check for a date:
    if (empty($_POST['date'])) {
        $errors[] = 'You forgot to enter the activity date.';
    } else {
        $date = $_POST['date'];
    }
    
    // Check for a time:
    if (empty($_POST['time'])) {
        $errors[] = 'You forgot to enter the activity time.';
    } else {
        $time = $_POST['time'];
    }
    
    // Check for a location:
    if (empty($_POST['location'])) {
        $errors[] = 'You forgot to enter the activity location.';
    } else {
        $location = trim($_POST['location']);
    }
    
    if (empty($errors)) { // If everything's OK.

        // Make the query:
        $q = "INSERT INTO activities (title, description, date, time, location) VALUES ('$title', '$description', '$date', '$time', '$location')";        
        $r = mysqli_query($dbc, $q); // Run the query.
        if ($r) { // If it ran OK.

            // Print a message:
            echo '<h1>Thank you!</h1>
            <p>The activity has been added.</p>';    

        } else { // If it did not run OK.
    
            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">The activity could not be added due to a system error. We apologize for any inconvenience.</p>'; 
    
            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
                
        } // End of if ($r) IF.
        
        mysqli_close($dbc); // Close the database connection.
        
        // Include the footer and quit the script:
        include ('../includes/admin-footer.html'); 
        exit();
        
    } else { // Report the errors.
    
        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
        
    } // End of if (empty($errors)) IF.

} // End of the main Submit conditional.
?>
<h1>Add Activity</h1>
<form action="add-news.php" method="post">
    <p>Activity Title: <input type="text" name="title" size="30" maxlength="60" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>" /></p>
    <p>Description: <textarea name="description" rows="5" cols="40"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea></p>
    <p>Date: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>" /></p>
    <p>Time: <input type="time" name="time" value="<?php if (isset($_POST['time'])) echo $_POST['time']; ?>" /></p>
    <p>Location: <input type="text" name="location" size="30" maxlength="60" value="<?php if (isset($_POST['location'])) echo $_POST['location']; ?>" /></p>
    <p><input type="submit" name="submit" value="Add Activity" /></p>
</form>
<?php include ('../includes/admin-footer.html'); ?>
</body>
</html>
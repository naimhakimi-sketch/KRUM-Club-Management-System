<?php 
// This page is for deleting a member record.
// This page is accessed through admin-members.php.

$page_title = 'Delete a Member';
include ('../includes/admin-header.html');
echo '<h1>Delete a Member</h1>';

// Check for a valid member ID, through GET or POST:
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From admin-members.php
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

    if ($_POST['sure'] == 'Yes') { // Delete the record.

        // Make the query:
        $q = "DELETE FROM members WHERE member_id=$id LIMIT 1";        
        $r = @mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

            // Print a message:
            echo '<p>The member has been deleted.</p>';

        } else { // If the query did not run OK.
            echo '<p class="error">The member could not be deleted due to a system error.</p>'; // Public message.
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
        }
    
    } else { // No confirmation of deletion.
        echo '<p>The member has NOT been deleted.</p>';    
    }

} else { // Show the form.

    // Retrieve the member's information:
    $q = "SELECT name FROM members WHERE member_id=$id";
    $r = @mysqli_query($dbc, $q);

    if (mysqli_num_rows($r) == 1) { // Valid member ID, show the form.

        // Get the member's information:
        $row = mysqli_fetch_array($r, MYSQLI_NUM);
        
        // Display the record being deleted:
        echo "<h3>Member: $row[0]</h3>
        Are you sure you want to delete this member?";
        
        // Create the form:
        echo '<form action="delete-member.php" method="post">
        <input type="radio" name="sure" value="Yes" /> Yes 
        <input type="radio" name="sure" value="No" checked="checked" /> No
        <input type="submit" name="submit" value="Submit" />
        <input type="hidden" name="id" value="' . $id . '" />
        </form>';
    
    } else { // Not a valid member ID.
        echo '<p class="error">This page has been accessed in error.</p>';
    }

} // End of the main submission conditional.

include ('../includes/admin-footer.html');
?>
</body>
</html>

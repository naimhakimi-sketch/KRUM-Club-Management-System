<?php

$page_title = 'Edit Member';
include ('../includes/admin-header.html');
echo '<h1>Edit Member</h1>';

if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
    $id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
    $id = $_POST['id'];
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
    include ('../includes/admin-footer.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array();

    if (empty($_POST['student_id'])) {
        $errors[] = 'You need to enter the student ID';
    } else {
        $student_id = trim($_POST['student_id']);
    }

    if (empty($_POST['name'])) {
        $errors[] = 'You need to enter the name';
    } else {
        $name = trim($_POST['name']);
    }

    if (empty($_POST['email'])) {
        $errors[] = 'You need to enter the email';
    } else {
        $email = trim($_POST['email']);
    }

    if (empty($_POST['programme'])) {
        $errors[] = 'You need to select a programme';
    } else {
        $programme = $_POST['programme'];
    }

    if (empty($_POST['position'])) {
        $errors[] = 'You need to select a position';
    } else {
        $position = $_POST['position'];
    }

    if (empty($errors)) {

        $q = "UPDATE members SET student_id='$student_id', name='$name', email='$email', programme='$programme', position='$position' WHERE member_id=$id";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) == 1) {
           
            if ($position == 'President' || $position == 'Vice President' || $position == 'Secretary' || $position == 'Treasurer') {
                $member_query = "SELECT * FROM members WHERE member_id=$id";
                $member_result = mysqli_query($dbc, $member_query);
                if ($member_row = mysqli_fetch_array($member_result, MYSQLI_ASSOC)) {
                    $hashed_password = sha1($member_row['password']);
                    $committee_q = "INSERT INTO committees (student_id, name, email, programme, position, password) VALUES ('{$member_row['student_id']}', '{$member_row['name']}', '{$member_row['email']}', '{$member_row['programme']}', '{$member_row['position']}', '{$member_row['password']}')";
                    $committee_r = @mysqli_query($dbc, $committee_q);
                    if (!$committee_r) {
                        // Log an error or display a message as needed.
                    }
                }
            }   
            else {
                $committee_query = "SELECT * FROM committees WHERE email='$email'"; // Enclose email in quotes
                $committee_result = mysqli_query($dbc, $committee_query); // Change variable name
                if(mysqli_num_rows($committee_result) == 1){
                    $remove_committee = "DELETE FROM committees WHERE email='$email'"; // Enclose email in quotes
                    $remove_result = mysqli_query($dbc, $remove_committee);
                }
            }
            echo '<p>The member has been edited.</p>';

        } else {
            echo '<p class="error">The member could not be edited due to a system error. We apologize for any inconvenience.</p>';
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
        }

    } else {

        echo '<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p>';

    }
}

$q = "SELECT student_id, name, email, registration_date, programme, position FROM members WHERE member_id=$id";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 1) {

    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    echo '<form action="edit-member.php" method="post">
<p>Student ID: <input type="text" name="student_id" size="15" maxlength="20" value="' . $row['student_id'] . '" /></p>
<p>Name: <input type="text" name="name" size="15" maxlength="40" value="' . $row['name'] . '" /></p>
<p>Email: <input type="text" name="email" size="15" maxlength="60" value="' . $row['email'] . '" /></p>
<p><b>Programme:</b>
<select name="programme">';
$programmes = array('BNS', 'BCS', 'BSE', 'BIOT', 'BCSS', 'BIMD', 'BCA', 'BCEM');
foreach ($programmes as $prog) {
    echo '<option value="' . $prog . '"';
    if ($prog == $row['programme']) echo ' selected="selected"';
    echo '>' . $prog . '</option>';
}
echo '</select></p>
<p><b>Position:</b>
<select name="position">
<option value="Regular Member"' . ($row['position'] == 'Regular Member' ? ' selected' : '') . '>Regular Member</option>
<option value="President"' . ($row['position'] == 'President' ? ' selected' : '') . '>President</option>
<option value="Vice President"' . ($row['position'] == 'Vice President' ? ' selected' : '') . '>Vice President</option>
<option value="Secretary"' . ($row['position'] == 'Secretary' ? ' selected' : '') . '>Secretary</option>
<option value="Treasurer"' . ($row['position'] == 'Treasurer' ? ' selected' : '') . '>Treasurer</option>
<option value="Subcommittee Leader"' . ($row['position'] == 'Subcommittee Leader' ? ' selected' : '') . '>Subcommittee Leader</option>
</select></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else {
    echo '<p class="error">This page has been accessed in error.</p>';
}

include ('../includes/admin-footer.html');
?>

</body>
</html>

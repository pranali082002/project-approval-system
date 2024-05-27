<?php
// Include your database connection file
include "../db.php";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file_id is set and not empty
    if (isset($_POST["file_id"]) && !empty($_POST["file_id"])) {
        // Sanitize input to prevent SQL injection
        $file_id = mysqli_real_escape_string($mysqli, $_POST["file_id"]);

        // Update the database to mark the file as approved
        $sql = "UPDATE student_file SET approval_status = 'Approved' WHERE id = '$file_id'";

        if (mysqli_query($mysqli, $sql)) {
            // File approval successful
            // You may want to handle granting access to the approved file to the students here
            // Redirect back to the previous page or any other page as needed
            header("Location: previous_page.php");
            exit;
        } else {
            // Error occurred while updating the database
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
        // file_id is not set or empty
        echo "File ID is not valid.";
    }
} else {
    // Form has not been submitted via POST method
    echo "This page cannot be accessed directly.";
}
?>

<?php 
include "../db.php";

// Check if the request method is POST and action parameter is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // Get the action and other parameters from the POST data
    $action = $_POST['action'];
    $facultyCode = $_POST['faculty_code'];
    $studentGroupCode = $_POST['student_group_code'];
    $submissionId = $_POST['submission_id'];
    
    // Establish database connection
    $conn = $mysqli; // Assuming $mysqli is your database connection object
    
    // Perform update based on the action
    if ($action === 'approve') {
        // Define the SQL query to insert approval record
        $query = "INSERT INTO faculty_approval (is_approved, comment, date_of_creation, time_of_creation, faculty_code, student_group_code, code) 
                  VALUES ('Y', 'Approved', CURDATE(), CURTIME(), ?, ?, ?)";
        
        // Prepare the SQL query
        $stmt = $conn->prepare($query);
        
        // Bind parameters to the prepared statement
        $stmt->bind_param("iii", $facultyCode, $studentGroupCode, $submissionId);
        
        // Execute the prepared statement
        $stmt->execute();
        
        // Check if the query executed successfully
        if ($stmt->affected_rows > 0) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        // Handle other actions if needed
    }
}
?>

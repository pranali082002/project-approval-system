<?php 
include "../db.php";
include 'header.php';
include 'sidebar.php';

$abc = $_SESSION["username"];
$sql = "SELECT s.*, f.code AS faculty_code FROM student_group AS s INNER JOIN faculty AS f ON f.code = s.faculty_code WHERE s.faculty_code='" . $abc["code"] . "'";
$res = mysqli_query($mysqli, $sql);
?>

<section class="content">
    <div class="container-fluid">
        <div class='form-row'>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="padding-left: 20px;padding-right: 20px;">
                    <div class="header">
                        <h2 style="text-align: center;">All Submissions</h2>
                    </div>
                    <div class="body">
                        <table class="table">
                            <thead>
                                <th>S.No</th>
                                <th>Group Email</th>
                                <th>Title</th>
                                <th>Comment</th>
                                <th>Date of Creation</th>
                                <th>Time Of Creation</th>
                                <th>File Type</th>
                                <th class="col-lg-1">File Name</th>
                                <th class="col-lg-2">Approval</th>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_array($res)) {
                                    $sql2 = "SELECT * FROM student_file WHERE group_code='" . $row["code"] . "'";
                                    $res2 = mysqli_query($mysqli, $sql2);
                                    while ($row2 = mysqli_fetch_array($res2)) {
                                        $submissionId = $row2["code"];
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row["email_id"]; ?></td>
                                            <td><?php echo $row2["title"]; ?></td>
                                            <td><?php echo $row2["comment"]; ?></td>
                                            <td><?php echo $row2["date_of_creation"]; ?></td>
                                            <td><?php echo $row2["time_of_creation"]; ?></td>
                                            <td><?php echo $row2["file_type"]; ?></td>
                                            <td><a href="/projectApprovalSystem/facultyPages/downloadFile.php?filename=<?php echo $row2["file"]; ?>"><?php echo $row2["file"]; ?></a></td>
                                            <td>
                                                <button class="btn btn-success" type="button" id="approveButton_<?php echo $submissionId; ?>" onclick="toggleButtons('approve', '<?php echo $submissionId; ?>', '<?php echo $row["faculty_code"]; ?>', '<?php echo $row["code"]; ?>')">Approve</button>
                                                &nbsp;
                                                <button class="btn btn-danger" type="button" id="rejectButton_<?php echo $submissionId; ?>" onclick="toggleButtons('reject', '<?php echo $submissionId; ?>')">Reject</button>
                                            </td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.html';
?>

<script>
   function toggleButtons(action, submissionId, facultyCode, groupCode) {
    var approveButton = document.getElementById('approveButton_' + submissionId);
    var rejectButton = document.getElementById('rejectButton_' + submissionId);

    if (action === 'approve') {
        // Disable both buttons
        approveButton.disabled = true;
        rejectButton.disabled = true;

        // Send AJAX request to PHP script
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateApproval.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                console.log('Response:', xhr.responseText); // Log the response

                if (xhr.status === 200) {
                    if (xhr.responseText.trim() === 'success') {
                        // If the approval is successful, update button text and hide reject button
                        approveButton.innerText = 'Approved';
                        rejectButton.style.display = 'none';
                    } else {
                        // If there's an error, enable buttons and alert the user
                        alert('Error occurred while approving.');
                        approveButton.disabled = false;
                        rejectButton.disabled = false;
                    }
                } else {
                    console.error('Request failed with status:', xhr.status); // Log any request errors
                }
            }
        };

        // Send the request with parameters
        xhr.send('action=approve&faculty_code=' + encodeURIComponent(facultyCode) + '&student_group_code=' + encodeURIComponent(groupCode) + '&submission_id=' + encodeURIComponent(submissionId));
    } else if (action === 'reject') {
        // Handle reject button action if needed
        approveButton.style.display = 'none';
        rejectButton.innerText = 'Rejected';
        rejectButton.disabled = true; 
    }
}


</script>
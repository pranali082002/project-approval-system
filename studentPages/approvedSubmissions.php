<?php
include 'header.php';
include 'sidebar.php';

$groupCode = $_SESSION["groupCode"];
$sql = "SELECT sf.* 
        FROM student_file sf
        INNER JOIN faculty_approval fa ON sf.code = fa.code 
        WHERE sf.group_code = '$groupCode' AND fa.is_approved = 'Y'";
$res = mysqli_query($mysqli, $sql);
?>

<section class="content">
    <div class="container-fluid">
        <div class='form-row'>
            <div class="col-lg-2"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card" style="padding-left: 20px;padding-right: 20px;">
                    <div class="header">
                        <h2 style="text-align: center;">Approved Submissions</h2>
                    </div>
                    <div class="body">
                        <table class="table" style="border: 1px solid black;">
                            <thead>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Comment</th>
                              <!--  <th>Date Of Creation</th>
                                <th>Time Of Creation</th>
                                 Add more columns if needed -->
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_array($res)) {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <!-- Replace the column names with actual column names from your table -->
                                        <td><?php echo $row["title"]; ?></td>
                                        <td><?php echo $row["comment"]; ?></td>
                                    <!--    <td><?php echo $row["date_of_creation"]; ?></td> -->
                                     <!--   <td><?php echo $row["time_of_creation"]; ?></td> -->
                                        <!-- Add more columns if needed -->
                                    </tr>
                                <?php
                                    $i++;
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
include "footer.html";
?>

<?php
ob_start();
require('dbconn.php');
?>

<?php
if ($_SESSION['RollNo']) {
    $RollNo = $_GET['id'];
    $sql1 = "delete from lms.user where RollNo = '$RollNo'";
    if ($conn->query($sql1) === TRUE) {
        echo "<script type='text/javascript'>alert('Success')</script>";
        header("Refresh:0.01; url=student.php", true, 303);
    } else { //echo $conn->error;
        echo "<script type='text/javascript'>alert('Error')</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>
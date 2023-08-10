<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$rollno = $_GET['id2'];

$sql = "select * from lms.user where RollNo='$rollno'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();



$sql1 = "update lms.record set Due_Date=date_add(Due_Date,interval 60 day),Renewals_left=0 where BookId='$bookid' and RollNo='$rollno'";

if ($conn->query($sql1) === TRUE) {
    $sql3 = "delete from lms.renew where BookId='$bookid' and RollNo='$rollno'";
    $result = $conn->query($sql3);

    $sql5 = "insert into lms.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for renewal of BookId: $bookid  has been accepted',curdate(),curtime())";
    $result = $conn->query($sql5);
    echo "<script type='text/javascript'>alert('Success')</script>";
    header("Refresh:0.01; url=renew_requests.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:0.01; url=renew_requests.php", true, 303);

}



?>
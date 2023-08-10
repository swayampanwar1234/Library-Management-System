<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$rollno = $_GET['id2'];

$sql = "select * from lms.user where RollNo='$rollno'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$sql1 = "update lms.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 60 day),Renewals_left=1 where BookId='$bookid' and RollNo='$rollno'";

if ($conn->query($sql1) === TRUE) {
    $sql3 = "update lms.book set Availability=Availability-1 where BookId='$bookid'";
    $result = $conn->query($sql3);
    $sql5 = "insert into lms.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for issue of BookId: $bookid has been accepted',curdate(),curtime())";
    $result = $conn->query($sql5);
    echo "<script type='text/javascript'>alert('Success')</script>";
    header("Refresh:0.01; url=issue_requests.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:1; url=issue_requests.php", true, 303);

}
?>
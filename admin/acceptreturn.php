<?php
require('dbconn.php');

$bookid = $_GET['id1'];
$rollno = $_GET['id2'];
$dues = $_GET['id3'];

$sql = "select * from lms.user where RollNo='$rollno'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql1 = "update lms.record set Date_of_Return=curdate(),Dues='$dues' where BookId='$bookid' and RollNo='$rollno'";

if ($conn->query($sql1) === TRUE) {
    $sql3 = "update lms.book set Availability=Availability+1 where BookId='$bookid'";
    $result = $conn->query($sql3);
    $sql4 = "delete from lms.return where BookId='$bookid' and RollNo='$rollno'";
    $result = $conn->query($sql4);
    $sql6 = "delete from lms.renew where BookId='$bookid' and RollNo='$rollno'";
    $result = $conn->query($sql6);
    $sql5 = "insert into lms.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for return of BookId: $bookid  has been accepted',curdate(),curtime())";
    $result = $conn->query($sql5);
    echo "<script type='text/javascript'>alert('Success')</script>";
    header("Refresh:0.01; url=return_requests.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error')</script>";
    header("Refresh:1; url=return_requests.php", true, 303);

}





?>
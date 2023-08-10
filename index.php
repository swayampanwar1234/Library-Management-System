<?php
require('dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LMS</title>
    <link rel="stylesheet" href="signup.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <script type="text/javascript" src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid" style="display: flex; justify-content: center; ">
            <div class="nav-header">
                <a class="navbar-brand" href="index.php">Library
                    Management System (LMS)</a>
            </div>
        </div>
    </nav>

    <span>
        <marquee direction="left" style="
                    color: white;
                    background-color: #283179;
                    align-items: center;
                ">Library opens at 8:00 AM and closes at 8:00 PM</marquee>
    </span>
    <div style=" margin-top: 8%; "></div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4" id="main_content" style=" margin-right: 20px; ">
            <center>
                <h3>Sign In</h3>
            </center>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="text">Roll Number:</label>
                    <input type="text" name="RollNo" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required />
                </div>
                <br />
                <button type="submit" name="signin" class="btn btn-primary" value="Sign In">
                    Sign in
                </button>
            </form>
        </div>
        <div class="col-md-4" id="main_content">
            <center>
                <h3>Sign Up</h3>
            </center>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="email">Email ID:</label>
                    <input type="email" name="email" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="number">Phone Number:</label>
                    <input type="text" name="number" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="email">Roll Number:</label>
                    <input type="text" name="RollNo" class="form-control" required />
                </div>
                <br />
                <button type="submit" name="signup" class="btn btn-primary" value="Sign Up">
                    Sign up
                </button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>

    <?php
    if (isset($_POST['signin'])) {
        $u = $_POST['RollNo'];
        $p = $_POST['password'];

        $sql = "select * from lms.user where RollNo='$u'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $x = $row['Password'];
        $y = $row['Type'];
        if (strcasecmp($x, $p) == 0 && !empty($u) && !empty($p)) { //echo "Login Successful";
            $_SESSION['RollNo'] = $u;


            if ($y == 'Admin')
                header('location:admin/index.php');
            else
                header('location:student/index.php');

        } else {
            echo "<script type='text/javascript'>alert('Failed to Login! Incorrect RollNo or Password')</script>";
        }
    }

    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mobno = $_POST['number'];
        $rollno = $_POST['RollNo'];
        $type = 'Student';

        $sql = "insert into lms.user (Name,Type,RollNo,EmailId,MobNo,Password) values ('$name','$type','$rollno','$email','$mobno','$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Registration Successful')</script>";
        } else {
            echo "<script type='text/javascript'>alert('User Exists')</script>";
        }
    }

    ?>

</body>

</html>
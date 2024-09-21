<?php
require 'users/connect.php';
session_start();


if(isset($_POST['register1']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['c-password'];

    $qry = "INSERT INTO job_seekers (name, email, mobile, username, password) VALUES ('$name', '$email', '$mobile', '$username', '$password')";

    if($conn->query($qry))
    {
        $_SESSION['success'] = "User Id Registered Successfully.";
        header('location: index.php');

    }
    else{
        die('Error: '. $conn->error);

    }
    

    // echo '<script>alert("User Registered Successfully")</script>';
}


if(isset($_POST['register2']))
{
    $name = $_POST['companyName'];
    $email = $_POST['email'];
    $number = $_POST['contactNumber'];
    $location = $_POST['companyLocation'];
    $password = $_POST['password'];
    $cpassword = $_POST['c-password'];

    $qry = "INSERT INTO employers (name, email, contact_number, location, password) 
    VALUES ('$name', '$email', '$number', '$location', '$password')";

    if(!$conn->query($qry))
    {
        die('Error: '.$conn->error);
    }
    // echo '<script>alert("User Registered Sucessfully")</script>';
    $_SESSION['success'] = "Employeer Id Registered Successfully.";

    header('location: index.php');
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBSite Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            display: none;
        }
        .active-form {
            display: block;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container mt-5">

        <header class="row">
            <div class="width-100">
            <div class="container header">
                <div class="width-25">
                    <img src="Images/jobsitelogo2.webp">
                </div>
                <div class="width-50">
                <ul class="header-menu ">
                    <li>
                    <a href="index.php">Home </a>
                    </li>
                    <li>
                    <a href="index.php #recent-jobs">Jobs </a>
                    </li>
                    <li>
                    <a href="index.php #companies">Companies </a>
                    </li>
                    <li>
                    <a href="index.php #services">Services </a>
                    </li>
                    <li>
                    <a href="index.php #footer">Contact Us </a>
                    </li>

                </ul>
                </div>
            </div>
            </div>
        </header>


        <h2 class="text-center mb-4">Register</h2>

        <div class="text-center mb-4">
            <button id="jobseekerBtn" class="btn btn-primary me-2">Job Seeker</button>
            <button id="employerBtn" class="btn btn-secondary">Employer</button>
        </div>

        <div id="jobseekerForm" class="form-container active-form">
            <form action="" method="post" class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
                <h3 class="text-center mb-4">Job Seeker Registration</h3>

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group mb-3">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" name="mobile" required>
                </div>

                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" required maxlength="10">
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group mb-3">
                    <label for="c-password">Confirm Password</label>
                    <input type="password" class="form-control" name="c-password" required>
                </div>

                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-primary w-100" name="register1" value="Register" onclick="return checkPwd()">
                </div>

                <div class="text-center">
                    <p>Already have an account? <a href="login.php" class="login">Login</a></p>
                </div>
            </form>
        </div>

        <div id="employerForm" class="form-container">
            <form action="" method="post" class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
                <h3 class="text-center mb-4">Employer Registration</h3>

                <div class="form-group mb-3">
                    <label for="companyName">Company Name</label>
                    <input type="text" class="form-control" name="companyName" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group mb-3">
                    <label for="mobile">Contact Number</label>
                    <input type="text" class="form-control" name="contactNumber" required>
                </div>

                <div class="form-group mb-3">
                    <label for="companyLocation">Company Location</label>
                    <input type="text" class="form-control" name="companyLocation" required>
                </div>


                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required minlength="6">
                </div>

                <div class="form-group mb-3">
                    <label for="c-password">Confirm Password</label>
                    <input type="password" class="form-control" name="c-password" required>
                </div>



                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-primary w-100" name="register2" value="Register" onclick="return checkPwd()">
                </div>

                <div class="text-center">
                    <p>Already have an account? <a href="login.php" class="login">Login</a></p>
                </div>
            </form>
        </div>

    </div>

    <script>
        function checkPwd()
            {
                $pwd = document.getElementsByName('password')[0];
                $cpwd = document.getElementsByName('c-password')[0];

                if($pwd !== $cpwd)
                {
                    alert('Password mismatch');
                    return false;
                }
                else{
                    return true;
                }
            }
    </script>





    <script>

        document.getElementById('jobseekerBtn').addEventListener('click', function () {
            document.getElementById('jobseekerForm').classList.add('active-form');
            document.getElementById('employerForm').classList.remove('active-form');
            this.classList.add('btn-primary');
            this.classList.remove('btn-secondary');
            document.getElementById('employerBtn').classList.add('btn-secondary');
            document.getElementById('employerBtn').classList.remove('btn-primary');
        });

        document.getElementById('employerBtn').addEventListener('click', function () {
            document.getElementById('employerForm').classList.add('active-form');
            document.getElementById('jobseekerForm').classList.remove('active-form');
            this.classList.add('btn-primary');
            this.classList.remove('btn-secondary');
            document.getElementById('jobseekerBtn').classList.add('btn-secondary');
            document.getElementById('jobseekerBtn').classList.remove('btn-primary');
        });

        function checkPwd() {
            const pwd = document.getElementsByName('password')[0].value;
            const cpwd = document.getElementsByName('c-password')[0].value;

            if (pwd !== cpwd) {
                alert('Password mismatch');
                return false;
            }
            return true;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
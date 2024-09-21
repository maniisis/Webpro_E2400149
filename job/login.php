<?php
require 'users/connect.php';
session_start();

if (isset($_POST['login_job_seeker'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM job_seekers WHERE email='$email' AND password='$password'";
    $data = $conn->query($qry);

    if ($data->num_rows > 0) {
        $user = $data->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['usertype'] = 'job_seeker';
        $_SESSION['success'] = "Login Successfully.";

        header('location: index.php');
    } else {
        echo "<script>alert('Invalid Job Seeker Credentials!')</script>";
    }
}

if (isset($_POST['login_employer'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM employers WHERE email='$email' AND password='$password'";
    $data = $conn->query($qry);

    if ($data->num_rows > 0) {
        $user = $data->fetch_assoc();
        $_SESSION['company_name'] = $user['name'];
        $_SESSION['company_id'] = $user['employer_id'];
        $_SESSION['success'] = "Login Successfully.";

        // $_SESSION['usertype'] = 'employer';
        header('location: index.php');
    } else {
        echo "<script>alert('Invalid Employer Credentials!')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
      * 
      {
        box-sizing: border-box;
      }

      body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
      }

      .login-container {
          width: 100%;
          max-width: 400px;
          background-color: #fff;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h2 {
          text-align: center;
          margin-bottom: 20px;
      }

      .form-group {
          margin-bottom: 15px;
      }

      .form-group label {
          display: block;
          margin-bottom: 5px;
          font-weight: bold;
      }

      .form-group input[type="email"],
      .form-group input[type="password"] {
          width: 100%;
          padding: 10px;
          font-size: 16px;
          border: 1px solid #ccc;
          border-radius: 4px;
      }

      .form-group button {
          width: 100%;
          padding: 10px;
          font-size: 16px;
          color: #fff;
          background-color: #007bff;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          transition: background-color 0.3s ease;
      }

      .form-group button:hover {
          background-color: #0056b3;
      }

      .form-footer {
          text-align: center;
          margin-top: 20px;
      }

      .form-footer a {
          color: #007bff;
          text-decoration: none;
          transition: color 0.3s ease;
      }

      .form-footer a:hover {
          color: #0056b3;
      }

      @media (max-width: 600px) {
          .login-container {
              padding: 15px;
          }

          .form-group input[type="email"],
          .form-group input[type="password"] {
              padding: 8px;
          }

          .form-group button {
              padding: 8px;
          }
      }

    </style>
</head>
<body>
 
    <div class="container">
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

    <div class="container">
        <div class="btn-container">
            <button class="btn btn-primary" onclick="showJobSeekerLogin()">Login</button>
        </div>

        <div class="login-container" id="jobSeekerForm">
            <h2>Login as Job Seeker</h2>
            <form method="post">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="login_job_seeker">Login as Job Seeker</button>
                </div>
            </form>
            <button class="btn btn-secondary switch-button" onclick="showEmployerLogin()">Switch to Employer Login</button>
        </div>

        <div class="login-container" id="employerForm">
            <h2>Login as Employer</h2>
            <form method="post">
                <div class="form-group">
                    <label for="email">Company Email</label>
                    <input type="text" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="login_employer">Login as Employer</button>
                </div>
            </form>
            <button class="btn btn-secondary switch-button" onclick="showJobSeekerLogin()">Switch to Job Seeker Login</button>
        </div>

        <script>
            function showJobSeekerLogin() {
                // Show Job Seeker form and hide Employer form
                document.getElementById('jobSeekerForm').style.display = 'block';
                document.getElementById('employerForm').style.display = 'none';
            }

            function showEmployerLogin() {
                // Show Employer form and hide Job Seeker form
                document.getElementById('jobSeekerForm').style.display = 'none';
                document.getElementById('employerForm').style.display = 'block';
            }

            // By default, show the Job Seeker login form when the page loads
            document.addEventListener('DOMContentLoaded', function() {
                showJobSeekerLogin();
            });
        </script>
    </div>

    <footer>
        <div class="width-100 footer-background">
        <div class="container">
            <div class="width-25">
            <h4>QUICK LINKS</h4>
            <ul class="footer-list">
                <li>C / C++ Jobs In Kathmandu</li>
                <li>Java Jobs In Kathmandu</li>
                <li>HTML Jobs In Kathmandu</li>
                <li>PHP Jobs In Kathmandu</li>
            </ul>
            </div>
            <div class="width-25">
            <h4>JOB TYPE</h4>
            <ul class="footer-list">
                <li>Bootstrap Jobs In Pokhara</li>
                <li>Website Designer Jobs In Pokhara</li>
                <li>Mobile App Jobs In Pokhara</li>
                <li>HR Executive Jobs In Pokhara</li>
            </ul>
            </div>
            <div class="width-25">
            <h4>RESOURCES</h4>
            <ul class="footer-list">
                <li>Home</li>
                <li>Post Free Job</li>
                <li>Recruiter Login</li>
                <li>Contact us</li>
            </ul>
            </div>
            <div class="width-25">
            <h4>GET IN TOUCH</h4>
            <ul class="get-in-touch">
                <li>
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                <p>E-MAIL: info@jobsite.com</p>
                </li>
                <li>
                <i class="fa fa-headphones" aria-hidden="true"></i>
                <p>WHATS-APP: +977 9863838379</p>
                </li>
                <li> 
                <li>
                <img src="Images/facebook.png">
                </li>
                <li>
                <img src="Images/x.png">
                </li>
                <li>
                <img src="Images/instagram.png">
                </li>
                <li>
                <img src="Images/linkedin.png">
                </li>
            </ul>
            </div>
        </div>
        </div>
    </footer>
</div>

</body>
</html>
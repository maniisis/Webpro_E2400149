
<?php
require 'users/connect.php';
session_start();

if(!isset($_SESSION['username']))
{
    header('location: login.php');
}

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['c-password'];

    $qry = "UPDATE job_seekers SET name='$name', email='$email', mobile='$mobile', password='$password'
    where username='". $_SESSION['username'] ."'";

    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }

    echo '<script>alert("User Registered Successfully")</script>';
    header('Location: index.php');
    exit();
}

$qry = "SELECT * FROM job_seekers
        WHERE username='".$_SESSION['username']."'";
$data = $conn->query($qry);
$user = $data->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        <section class="row">
            <form method="post" class="col-md-4 offset-md-4 mt-5">
                
                <h3 class="text-center mb-3">Update Profile</h3>

                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" 
                    name="name" required 
                    value="<?php echo $user['name'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" 
                    name="email" required value="<?php echo $user['email'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Mobile</label>
                    <input type="text" class="form-control" 
                    name="mobile" required value="<?php echo $user['mobile'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Username</label>
                    <input type="text" class="form-control" 
                    name="username" required maxlength="10" readonly 
                    value="<?php echo $user['username'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" 
                    name="password" required minlength="6" 
                    value="<?php echo $user['password'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="">Confirm - Password</label>
                    <input type="password" class="form-control" 
                    name="c-password" required value="<?php echo $user['password'] ?>">
                </div>

                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-primary" 
                    name="update" value="Update" onclick="return checkPwd()">
                </div>


                <script>
                    function checkPwd() {
                        let pwd = document.getElementsByName('password')[0].value;
                        let cpwd = document.getElementsByName('c-password')[0].value;

                        if (pwd !== cpwd) {
                            alert('Password mismatch');
                            return false;
                        }
                        return true;
                    }
                </script>


            </form>
        </section>

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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
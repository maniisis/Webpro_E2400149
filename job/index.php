<?php
require 'users/connect.php';
session_start();
?>


<!DOCTYPE html>
 <html lang="en">
  <head>
   <title>JOBSiTE</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
        <header">
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
                    <a href="#recent-jobs">Jobs </a>
                    </li>
                    <li>
                    <a href="#companies">Companies </a>
                    </li>
                    <li>
                    <a href="#services">Services </a>
                    </li>
                    <li>
                    <a href="#contacts">Contact Us </a>
                    </li>

                </ul>
                </div>
  

                <?php
                
                if(isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success' role='alert'>
                   ".$_SESSION['success']."
                  </div>";
                }?>
                <div class="width-25">


                <?php 
                if(isset($_SESSION['username']) || isset($_SESSION['company_name'])) {
                ?>   
                <a href="profile.php" class="button-resume">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Profile </a>
                <a href="logout.php" class="button-resume">
                <i class="fa fa-user-plus" aria-hidden="true"></i> logout </a>

                <?php } else { ?>
                    <a href="login.php" class="button-job-post">
                    <i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN </a>
                    <a href="register.php" class="button-resume">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> Sign up </a>
                <?php } ?> 






                </div>
            </div>
            </div>
        </header>


        <div class="width-100 banner-section">
            <div class="container">
                <h1 class="banner-heading">Find The Best Job For Your Future</h1>
                <p class="banner-para">Apply with Ease, and take the next step in your career.</p>

                <!-- Search Form -->
                <form action="searchjobs.php" method="GET">
                    <div class="search-sect">
                        <input type="text" class="search-textbox" name="job_title" placeholder="Enter Job Title">
                    </div>

                    <div class="search-sect">
                        <input type="text" class="search-textbox" name="company_name" placeholder="Enter Company Name">
                    </div>

                    <div class="search-sect">
                        <input type="text" class="search-textbox" name="comapanylocation" placeholder="Enter Location">
                    </div>

                    <div class="search-sect">
                        <button type="submit" class="search-button">
                            <i class="fa fa-search" aria-hidden="true"></i> Search Here
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="width-100 recent-job">
            <div class="container">
            <h2 class="recent-job-heading">RECENT JOB</h2>
            <p class="recent-job-sub-heading">Get the list of all recent jobs</p>
            <?php
// Include the connection file

// Query to fetch the job postings
$sql = "SELECT job_title, company_name, job_location, experience_requirements, salary_range, key_skills 
        FROM job_postings ORDER BY created_at DESC LIMIT 6";  // Fetch the latest 6 job postings
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output each job in the desired HTML structure
        echo '<div class="width-50">';
        echo '    <div class="recent-job-list">';
        echo '        <div class="width-100">';
        echo '            <h4 class="job-title">' . $row['job_title'] . '</h4>';
        echo '            <p class="job-company">' . $row['company_name'] . ' <i class="fa fa-star" aria-hidden="true"></i> | 234 Reviews </p>';
        echo '        </div>';
        echo '        <div class="width-33">';
        echo '            <i class="fa fa-briefcase" aria-hidden="true"></i> ' . $row['experience_requirements'] . ' Years';
        echo '        </div>';
        echo '        <div class="width-33">';
        echo '            <i class="fa fa-inr" aria-hidden="true"></i> ' . ($row['salary_range'] ? $row['salary_range'] : 'Negotiable');
        echo '        </div>';
        echo '        <div class="width-33">';
        echo '            <i class="fa fa-map-marker" aria-hidden="true"></i> ' . $row['job_location'];
        echo '        </div>';
        echo '        <div class="width-100">';
        echo '            <p class="job-skill"><b>Skills : </b>' . $row['key_skills'] . '</p>';
        echo '        </div>';
        echo '        <div class="width-100">';
        echo '            <a href="apply.html" class="job-apply-button">Apply Now</a>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<p>No jobs available at the moment.</p>';
}

// Close the database connection
$conn->close();
?>

           
            </div>
        </div>
        
        <div class="width-100 top-company" id="companies">
            <div class="container">
            <h2 class="top-company-heading">Top Company Hiring</h2>
            <p class="top-company-sub-heading">List of Top Company Hiring With Us</p>

            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/google.png">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">Google Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>

            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/ibm.jpg">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">IBM Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>

            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/apple.png">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">Apple Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>

            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/infosys.jpg">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">InfoSys Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>

            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/wipro.png">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">Wipro Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>

            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/hcl.png">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">HCL Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>

            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/linkedin.png">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">Linkedin Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>


            <div class="width-25">
                <div class=" company-list">
                <div class="width-100">
                    <div class="width-25 company-image">
                    <img src="Images/Microsoft.png">
                    </div>
                    <div class="width-75">
                    <h4 class="company-name">Microsoft Company</h4>
                    <p class="company-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star " aria-hidden="true"></i>
                    </p>
                    <p class="company-review">( 874 Reviews)</p>
                    </div>
                </div>
                <div class="width-50 company-address">New York, USA</div>
                <div class="width-50 company-opening">25 Job Opening </p>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="width-100 feature-sect" id="services">
            <div class="container">
            <div class="width-50">
                <div class="feature-panel">
                <img src="Images/feature1.png" class="feature-img">
                <h4 class="feature-title">DO YOU WANT TO FIND A JOB ?</h4>
                <a href="findjobs.php">
                    <button class="feature-btn">Find Job</button>
                </a>
                </div>
            </div>
            <div class="width-50">
                <div class="feature-panel">
                <img src="Images/feature2.png" class="feature-img">
                <h4 class="feature-title"> ARE YOU LOOKING FOR AN EMPLOYEE ?</h4>
                <a href="postjobs.php">
                    <button class="feature-btn">Post Job</button>
                </a>
            </div>
            </div>
            </div>
        </div>


        <footer >
            <div class="width-100 footer-background" id="contacts">
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
    </body>
</html>
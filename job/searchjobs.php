<?php
require 'users/connect.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Search Results</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header>
    <div class="container header">
        <div class="width-25">
            <img src="Images/jobsitelogo2.webp" alt="Job Site Logo">
        </div>
        <div class="width-50">
            <ul class="header-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="#recent-jobs">Jobs</a></li>
                <li><a href="#companies">Companies</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contacts">Contact Us</a></li>
            </ul>
        </div>
        <div class="width-25">
            <?php if (isset($_SESSION['username'])) { ?>   
                <a href="profile.php" class="button-resume"><i class="fa fa-user-plus" aria-hidden="true"></i> Profile</a>
                <a href="logout.php" class="button-resume"><i class="fa fa-user-plus" aria-hidden="true"></i> Logout</a>
            <?php } else { ?>
                <a href="login.php" class="button-job-post"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN</a>
                <a href="register.php" class="button-resume"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign up</a>
            <?php } ?> 
        </div>
    </div>
</header>

<div class="container mt-5">
    <h2>Search Results: "<?php //echo htmlspecialchars($job_title); ?>"</h2>

    <?php
    // Check if there are any results
    if (isset($_GET['job_title']) || isset($_GET['company_name']) || isset($_GET['company_location'])) {
        $job_title = $_GET['job_title'] ?? '';
        $company = $_GET['company_name'] ?? '';
        $location = $_GET['company_location'] ?? '';
    
        // Secure the query to prevent SQL injection
        // $job_title = mysqli_real_escape_string($conn, $job_title);
        // $company = mysqli_real_escape_string($conn, $company);
        // $location = mysqli_real_escape_string($conn, $location);
    
        // Build the SQL query based on input
        $qry = "SELECT * FROM job_postings WHERE 1=1"; // 1=1 ensures that additional conditions can be appended safely
        $qry1 = "SELECT * FROM employers WHERE 1=1";
        $qry2 = "SELECT * FROM employers WHERE 1=1";
    
        if ($job_title != '') {
            $qry .= " AND job_title LIKE '%$job_title%'";
        }
        if ($company != '') {
            $qry1 .= " AND company_name LIKE '%$company%'";
        }
        if ($location != '') {
            $qry2 .= " AND location LIKE '%$company_location%'";
        }
    
        $result = $conn->query($qry);
    
        // Display results
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
    }

    // Close the database connection
   
    ?>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 JOBSiTE. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7/9XQ7Qx0g0Ik9Gg6Z4XoKzA3W4jJhM1qD6Dd1z2QnIf4/B5g" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w8yAVDg8L6sk2D7U9I6mGUNYxj3z48SxqgIYHqIu1Ty06zC2YwqFOfxdB3/SuQUC" crossorigin="anonymous"></script>
</body>
</html>
<?php
session_start();
require 'users/connect.php';

// Check if the company is logged in
if(!isset($_SESSION['company_id'])) {
    echo '<script>alert("Please log in as a company to post jobs.")</script>';
    header('location: login.php'); // Redirect to login page
    exit();
}

if(isset($_POST['submit']))
{$company_id=$_SESSION['company_id'];
    $job_title = $_POST['jobTitle'];
    $company_name = $_POST['companyName'];
    $location = $_POST['companyLocation'];
    $qualifications = $_POST['qualifications'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $salary = $_POST['salary_range'];
    $job_description = $_POST['jobDescription'];

    $qry = "INSERT INTO job_postings (employer_id, job_title, company_name, job_location, qualifications, experience_requirements, key_skills, salary_range, job_description)
    VALUES ('$company_id', '$job_title', '$company_name', '$location', '$qualifications', '$experience', '$skills', '$salary', '$job_description')";

    if(!$conn->query($qry))
    {
        die('Error: '. $conn->error);
    }
    $_SESSION['success'] = "Job Posted Successfully.";

    echo '<script>alert("Job Posted Successfully")</script>';
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Information Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            resize: vertical;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Job Information Form</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="jobTitle">Job Title:</label>
                <input type="text" id="jobTitle" name="jobTitle" required>
            </div>
            <div class="form-group">
                <label for="companyName">Company Name:</label>
                <input type="text" id="companyName" name="companyName" required>
            </div>

            <div class="form-group">
                <label for="companyLocation">Company Location:</label>
                <input type="text" id="companyLocation" name="companyLocation" required>
            </div>
            <div class="form-group">
                <label for="qualifications">Required Qualifications:</label>
                <textarea id="qualifications" name="qualifications" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="experience">Experience Requirements:</label>
                <input type="text" id="experience" name="experience" required>
            </div>
            <div class="form-group">
                <label for="skills">Key Skills:</label>
                <textarea id="skills" name="skills" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="salaryRange">Salary Range:</label>
                <input type="text" id="salaryRange" name="salary_range" required>
            </div>
            <div class="form-group">
                <label for="jobDescription">Job Description:</label>
                <textarea id="jobDescription" name="jobDescription" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>

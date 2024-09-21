<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'jobsite1';

$conn = new mysqli($host, $user, $password, $database);

if($conn->connect_error)
{
    die("Connection Error: ". $conn->connect_error);
}
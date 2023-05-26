<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'book_db';

$connection = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
  }

if (isset($_POST['send'])) {
    
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $guests = mysqli_real_escape_string($connection, $_POST['guests']);
    $arrivals = mysqli_real_escape_string($connection, $_POST['arrivals']);
    $leaving = mysqli_real_escape_string($connection, $_POST['leaving']);
    
    
    $query = "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $phone, $address, $location, $guests, $arrivals, $leaving);
    $result = mysqli_stmt_execute($stmt);
    
    
    if ($result) {
        header('Location: book.php');
        exit;
    } else {
        echo 'Something went wrong. Please try again.';
    }
}
mysqli_close($connection);

?>

<?php

// Set up database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'book_db';

try {
    $connection = mysqli_connect($host, $username, $password, $dbname);
    if (!$connection) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

// Insert user input into database
if (isset($_POST['send'])) {
    // Validate input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $guests = $_POST['guests'];
    $arrivals = $_POST['arrivals'];
    $leaving = $_POST['leaving'];
    
    // Perform input validation
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($location) || empty($guests) || empty($arrivals) || empty($leaving)) {
        echo 'Please fill out all fields.';
        exit;
    }
    
    // Prepare and execute query
    $query = "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $phone, $address, $location, $guests, $arrivals, $leaving);
    $result = mysqli_stmt_execute($stmt);
    
    // Handle result
    if ($result) {
        header('Location: book.php');
        exit;
    } else {
        echo 'Something went wrong. Please try again.';
    }
}

// Close database connection
mysqli_close($connection);

?>

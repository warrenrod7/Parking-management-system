<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dmqp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$name = $_POST['name'];
$phone = $_POST['phone'];
$password = password_hash($_POST['createPassword'], PASSWORD_DEFAULT); // Hash the password for security

// Prepare and execute SQL query to insert data into the table
$sql = "INSERT INTO users (name, phoneno, pword) VALUES ('$name', '$phone', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

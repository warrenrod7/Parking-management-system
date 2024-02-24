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

// Get username and password from a form or any other source
$user = $_POST['lphone'];
$pass = $_POST['loginPassword'];

// Prevent SQL injection
$user = mysqli_real_escape_string($conn, $user);
$pass = mysqli_real_escape_string($conn, $pass);

// Query to check if the username and password match
$query = "SELECT * FROM users WHERE Phone='$user' AND Password='$pass'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    if(!isset($_SESSION))
    session_start();
    $_SESSION['phone']=$user;
    // Username and password are correct
    // Redirect to userinterface.php
    header("Location: user interface.php");
    exit(); // Make sure to exit after redirection
} else {
    // Username and password are incorrect
    echo "<script>alert('Incorrect Password')</script>";
    header("Location: home.html");
}

// Close connection
$conn->close();
?>

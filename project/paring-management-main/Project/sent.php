<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment QR Code</title>
    <style>
        img{
            width: 400px;
            height: 400px;
            position: relative;
            left: 547px;
            top: 8px;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-image:url('https://wallpaperaccess.com/full/4327493.jpg');
            background-size:cover;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        h1{
            text-align: center;
            color:#ffffff;
        }
       

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        main {
            padding: 20px;
        }
    </style>
</head>
<body>
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
$message = $_POST['contactus'];

// Prepare and execute SQL query to insert data into the table
$sql = "INSERT INTO contact_us (messages) VALUES ('$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message stored successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>


    <header>
        <h1>Welcome to Parking Management System</h1>
    </header>

    <!-- Navigation Bar -->
    <nav>
        <a href="#">User Details</a>
        <a href="booking.html">Booking</a>
        <a href="contactus.html">Contact Us</a>
        <a href="home.html">Log Out</a>
    </nav>

    <h1><br><br>Message sent !</h1>

</body>
</html>

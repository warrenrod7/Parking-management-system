<?php
    if(isset($_GET['logout'])){
        session_start();
        session_unset();
        session_destroy();
        echo "<script>alert('Logout Successful')</script>";
        header('Location: home.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interface Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            align:center;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-image: url('https://i.postimg.cc/Hk5V1FNJ/5218617.jpg');
            background-size:cover;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            
        }

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }
        
        h1{
            text-align: center;
            color:#ffffff;
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
<body >

    <!-- Header Section -->
    <header>
        <h1>Welcome to Parking Management System</h1>
    </header>

    <!-- Navigation Bar -->
    <nav>
    <a href="vehicle.php">Register Vehicle</a>
        <a href="vehdetails.php">Vehicle Details</a>
        <a href="booking.php">Booking</a>
        <a href="unbook.php">Unbook</a>
        <a href="successfull.php?logout">Log Out</a>
    </nav>
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
$vehno = $_POST['vehno'];
$pid= $_POST['transactionId'];
$amt = $_POST['amount'];

// Prepare and execute SQL query to insert data into the table
$sql = "INSERT INTO payment (PaymentID, Amount, VehicleID) VALUES ('$pid', '$amt', '$vehno')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>


<h1><br><br>Booking successfull !</h1>

</body>
</html>
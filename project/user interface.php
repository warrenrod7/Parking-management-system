<?php
    if(isset($_GET['logout'])){
        session_start();
        session_unset();
        session_destroy();
        echo "<script>alert('Logout Successful');</script>";
        header('Location: home.html');
        exit(); // Add exit to stop script execution after redirection
    }
?>

<?php
if (isset($_POST['createacc'])) {
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

    // Get data from the form (use mysqli_real_escape_string to prevent SQL injection)
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pw = mysqli_real_escape_string($conn, $_POST['createPassword']);

    // Prepare and execute SQL query using prepared statements
    $stmt = $conn->prepare("INSERT INTO users (Name, Phone, Email, Password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $phone, $email, $pw);

    if ($stmt->execute()) {
        echo "Registration successful";
        $stmt->close();
        $conn->close();
        header('Location: home.html');
        exit(); // Add exit to stop script execution after redirection
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }
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
        <a href="user%20interface.php?logout">Log Out</a>
    </nav>



</body>
</html>
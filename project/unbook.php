<?php
    if(isset($_GET['logout'])){
        session_start();
        session_unset();
        session_destroy();
        echo "<script>alert('Logout Successful')</script>";
        header('Location: home.html');
    }
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dmqp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['unbook'])) {
    // Get data from the form
    $parkingLotID = $_POST['parking_lot_id'];
    $vehicleID = $_POST['vehicle_id'];
    
    // Check if the parking slot is booked
    $checkBookingQuery = "SELECT * FROM parkinglot WHERE ParkingLotID = $parkingLotID AND VehicleID = $vehicleID AND status = 'Booked'";
    $result = $conn->query($checkBookingQuery);

    if ($result->num_rows > 0) {
        // Update the status to 'Available'
       // $updateStatusQuery = "UPDATE parkinglot SET status = 'Available' WHERE ParkingLotID = $parkingLotID AND VehicleID = $vehicleID";
       $deleteTupleQuery = "DELETE FROM parkinglot WHERE ParkingLotID = $parkingLotID AND VehicleID = $vehicleID";

       if ($conn->query($deleteTupleQuery) === TRUE) {

            echo "<h3 align='center'>Parking slot unbooked successfully</h3>";
            header("Location: user interface.php");
            exit();
        } else {
            echo "Error updating status: " . $conn->error;
        }
    } else {
        echo "Parking slot is not booked or does not exist for the specified vehicle.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unbook Parking Slot</title>
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

        .container {
            width: 300px;
            margin: 100px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            
        }

        button {
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            align:center;
        }
       

        input[type="text"],
        /*input[type="password"],
        input[type="email"],*/
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .create-account {
            margin-top: 10px;
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
        h2 {
    /* sets the color of h1 element to blue */
    color: white;
}
nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<header>
        <h1>Welcome to Parking Management System</h1>
    </header>

<nav>
<a href="vehicle.php">Register Vehicle</a>
        <a href="vehdetails.php">Vehicle Details</a>
        <a href="booking.php">Booking</a>
        <a href="unbook.php">Unbook</a>
        <a href="unbook.php?logout">Log Out</a>

    </nav>
<br><br>
   <h2 align="center" color="white">Unbook Parking Slot</h2>
    <div class="container">
        
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="parking_lot_id">Parking Lot Number:</label>
        <input type="text" id="parking_lot_id" name="parking_lot_id" required>
        <br>
        <label for="vehicle_id">Vehicle Number:</label>
        <input type="text" id="vehicle_id" name="vehicle_id" required>
        <br>   
        <button type="submit" name="unbook" align="center">Unbook Parking Slot</button>
    </form>
    </div>
</body>
</html>
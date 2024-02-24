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
    <title>Payment QR Code</title>
    <style>
        img {
            width: 300px;
            height: 300px;
            position: relative;
            left: 580px;
            top: 8px;
        }
        
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
        h1 {
            text-align: center;
        }
        p {
            text-align: center;
            color: aliceblue;
            font-weight:bold;
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
        #details-container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 20px;
            background-color: azure;
            align-items: center;
            justify-content: center;
            position: relative;
            top:20px;
            left: 575px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<?php
// Check if form is submitted
if (isset($_POST['submitbtn'])) {
    // Retrieve the selected parking lot and other details from the form
    $selectedParkingLot = $_POST['selectedParkingLot'];
    $vehicleNo = $_POST['vehicle_no'];
    $date = $_POST['date'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $amount = $_POST['amount'];

    // Connect to your database (replace with your actual credentials)
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dmqp";

    $con = mysqli_connect($host, $username, $password, $dbname);

    if (!$con) {
        die("Connection failed!" . mysqli_connect_error());
    }

    // Update the status of the selected parking lot to 'Booked'
    $updateSql = "UPDATE parkinglot SET status = 'Booked' WHERE ParkingLotID = $selectedParkingLot";
    mysqli_query($con, $updateSql);

    // Insert the booking details into the parkinglot table
    $insertSql = "INSERT INTO parkinglot (ParkingLotID, status, VehicleID, ddate, stime, etime) 
                  VALUES ('$selectedParkingLot', 'Booked', '$vehicleNo', '$date', '$startTime', '$endTime')";
    mysqli_query($con, $insertSql);

    mysqli_close($con);

    // Redirect to a confirmation page or perform any other necessary actions
   /* header("Location: payment.php");
    exit(); */
}
?>



    <header>
        <h1>Welcome to Parking Management System</h1>
    </header>

    <!-- Navigation Bar -->
    <nav>

    <a href="vehicle.php">Register Vehicle</a>
        <a href="vehdetails.php">Vehicle Details</a>
        <a href="booking.php">Booking</a>
      
        <a href="payment.php?logout">Log Out</a>
    </nav>

    <h1 style="color:white;" >Scan the QR Code to Pay</h1>

    <img src="WhatsApp Image 2023-10-21 at 21.17.37_a5eabdaf.jpg" alt="Payment QR Code" sizes="2">

    <p>Please use your mobile banking app to scan the QR code and complete the payment.</p>
    <div id="details-container"  >
    <form action="successfull.php" method="post">
    <label for="transactionId">Transaction ID:</label>
    <input type="text" id="transactionId" name="transactionId" placeholder="Enter Transaction ID" required>

    <input type="hidden" name="vehno" value="<?php echo isset($vehicleNo) ? htmlspecialchars($vehicleNo) : ''; ?>" readonly>
    <input type="hidden" name="amount" value="<?php echo isset($amount) ? htmlspecialchars($amount) : ''; ?>" readonly>
    <button type="submit" name="submitbtn">Submit</button>
</div>
</form>


    <p><br>Once the payment is successful, your order will be processed.</p>

</body>
</html>

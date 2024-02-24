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
    <title>User Details Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
           
            flex-direction: column;
            height: 100vh;
            background-image: url('https://i.postimg.cc/Hk5V1FNJ/5218617.jpg');
            background-size:cover;
            background-attachment: fixed;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #444;
            padding: 10px;
            width: 100%;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
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

    <header>
        <h1 style="color: #ffffff;">Booking</h1>
    </header>

    <nav>
    <a href="vehicle.php">Register Vehicle</a>
        <a href="vehdetails.php">Vehicle Details</a>
        <a href="booking.php">Booking</a>
        <a href="unbook.php">Unbook</a>
        <a href="details.php?logout">Log Out</a>
    </nav>
    <?php
    // Check if the 'parkingLot' parameter is set in the URL
    if (isset($_GET['parkingLot'])) {
        // Retrieve the selected parking lot value from the URL
        $selectedParkingLot = $_GET['parkingLot'];

        // Display the selected parking lot
       // echo " $selectedParkingLot.</p>";
    } else {
        // Display a message if the parameter is not set
        echo "<p>No parking lot selected.</p>";
    }
    ?>
    <div id="details-container"  >
        <h2>Enter Your Details</h2>
        <!-- Form to collect user details -->
        <form action="payment.php" method="POST" >
          
        Parking slot selected:
        <input type="text" name="selectedParkingLot" value="<?php echo isset($selectedParkingLot) ? htmlspecialchars($selectedParkingLot) : ''; ?>" readonly>

            <label for="vehicle_no">Vehicle No:</label>
            <input type="text" id="vehicle_no" name="vehicle_no" placeholder="GA-00 A-0000" >

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" readonly>


            <label for="startTime">Start time:</label>
            <input type="time" id="startTime" name="startTime" placeholder="HH:mm" required>

            <label for="endTime">End time:</label>
            <input type="time" id="endTime" name="endTime" placeholder="HH:mm" required oninput="calculateFee()">

             <p id="result"></p>

             <!-- Hidden input field to store the calculated amount -->
             <input type="hidden" id="amount" name="amount" value="">


             <button type="submit" value="submit" name="submitbtn">Submit</button>
             
        </form>
    </div>

    <script>
        
        function calculateFee() {
           
            var startTime = document.getElementById("startTime").value;
            var endTime = document.getElementById("endTime").value;
           
            var startDate = new Date("1970-01-01T" + startTime + ":00Z");
            var endDate = new Date("1970-01-01T" + endTime + ":00Z");
           
            var timeDiffInMinutes = (endDate - startDate) / (1000 * 60);
            
            var feePerMinute = 1;
         
            var totalFee = timeDiffInMinutes * feePerMinute;

            document.getElementById("result").innerHTML = "Total Fee: Rs" + totalFee.toFixed(2);
            document.getElementById("amount").value = totalFee.toFixed(2);
        }
   
    </script>

</body>
</html>

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
        <h1 style="color: #ffffff;">Welcome To Parking Management System</h1>
    </header>

    <nav>
    <a href="vehicle.php">Register Vehicle</a>
        <a href="vehdetails.php">Vehicle Details</a>
        <a href="booking.php">Booking</a>
        <a href="unbook.php">Unbook</a>
        <a href="vehicles.html?logout">Log Out</a>
    </nav>

    <div id="details-container"  >
        <h2>Enter Your Details</h2>
        <!-- Form to collect user details -->
        <form action="vehstored.php" method="POST">
           
            <label for="phone">Mobile Number:</label>
            <input type="number" id="phone" name="phone" required>

            <label for="vehicle_no">Vehicle No:</label>
            <input type="text" id="vehicle_no" name="vehicle_no" placeholder="GA-00 A-0000" required>

            <label for="model">Vehicle Model:</label>
            <input type="text" id="model" name="model" placeholder="Eg:Honda,Maruthi etc" required>
           
             <button type="submit" value="submit" name="submitbtn">Submit</button>
             
        </form>
    </div>


</body>
</html>

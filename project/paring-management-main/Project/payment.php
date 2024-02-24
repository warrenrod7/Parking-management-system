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
        }
        p{
            text-align: center;
            color: aliceblue;
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
    // getting all values from the HTML form
    if(isset($_POST['submitbtn']))
    {
        
        $vehno = $_POST['vehicle_no'];
        $datee = $_POST['date'];
        $starttime = $_POST['startTime'];
        $endtime = $_POST['endTime'];
    
    }

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dmqp";

    $con = mysqli_connect($host, $username, $password, $dbname);
    
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }
 
    $sql = "INSERT INTO bookings (vehno,ddate,stime,endtime) VALUES ('$vehno', '$datee','$starttime','$endtime')";
    
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Entries added!";
    }
  
    mysqli_close($con);

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

    <h1 style="color: antiquewhite;" >Scan the QR Code to Pay</h1>

    
    <img src="WhatsApp Image 2023-10-21 at 21.17.37_a5eabdaf.jpg" alt="Payment QR Code" sizes="2">

    <p>Please use your mobile banking app to scan the QR code and complete the payment.</p>

    <p>Once the payment is successful, your order will be processed.</p>

</body>
</html>

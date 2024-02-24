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
// Retrieve the parking lot numbers and booking status from the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dmqp";

$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con) {
    die("Connection failed!" . mysqli_connect_error());
}

// Fetch the booking status for each parking lot
$sql = "SELECT ParkingLotID, status FROM parkinglot";
$result = mysqli_query($con, $sql);

// Create an array to store booking status for each parking lot
$bookingStatusArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $bookingStatusArray[$row['ParkingLotID']] = $row['status'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Lot Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-image: url('https://i.postimg.cc/Hk5V1FNJ/5218617.jpg');
            background-size: cover;
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
            width: 100%;

        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
            width: 100%;
        }

        main {
            padding: 20px;
        }

        .parking-lot {
            display: inline-block;
            width: 120px;
            height: 120px;
            background-color: white;
            margin: 10px;
            cursor: pointer;
            line-height: 120px;
            border-radius: 20px
        }

        .selected {
            background-color: #4caf50;
            color: #fff;
        }

        .parking-lot.booked {
            background-color: #FF0000; /* Red color for booked spots */
            color: #fff;
        }

        button {
            padding: 10px 10px;
            font-size: 13px;
            cursor: pointer;
            background-color: #1ecf50;
            color: #fff;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <header>
        <h1 align="center" style="color:white;">Welcome to Parking Management System</h1>
    </header>

    <nav>
    <a href="vehicle.php">Register Vehicle</a>
        <a href="vehdetails.php">Vehicle Details</a>
        <a href="booking.php">Booking</a>
        <a href="unbook.php">Unbook</a>
        <a href="booking.php?logout">Log Out</a>
    </nav>
    <h1 style="color:white; text-align:center;"><br>Select a Parking Lot<br></h1>

    <div id="parking-lots">
    <?php for ($i = 1; $i <= 20; $i++) { ?>
            <?php
            // Determine the class and style based on the booking status
            $class = isset($bookingStatusArray[$i]) && $bookingStatusArray[$i] === 'Booked' ? 'booked' : '';
            ?>
            <div class="parking-lot <?php echo $class; ?>" onclick="selectParkingLot(<?php echo $i; ?>)">PL <?php echo $i; ?></div>
        <?php } ?>
            

    <div id="selected-info">
        <p style="color:white; text-align:center;"><br><br><br><br><br>You selected Parking Lot <span id="selected-lot">None</span>.</p>
    </div>

    <!-- Add a hidden input field to store the selected parking lot value -->
    <form action="details.php" method="GET">
        <input type="hidden" name="parkingLot" id="hidden-lot" value="">
        <button style="border-radius: 5px; font-size: medium;" type="submit">Confirm</button>
    </form>

    <script>
    //     function selectParkingLot(lotNumber) {
    //         var parkingLots = document.querySelectorAll('.parking-lot');
    //         parkingLots.forEach(function (lot) {
    //             lot.classList.remove('selected');
    //         });

    //         var selectedLot = document.getElementById('selected-lot');
    //         selectedLot.textContent = lotNumber;

    //         var hiddenInput = document.getElementById('hidden-lot');
    //         hiddenInput.value = lotNumber;

    //     var selectedParkingLot = document.querySelector('.parking-lot:nth-child(' + lotNumber + ')');
    //     selectedParkingLot.classList.add('selected');

    //     // Additional code to change the color of the selected parking lot
    //     selectedParkingLot.style.backgroundColor = 'red'; // Red color
    // }
    function selectParkingLot(lotNumber) {
    var parkingLots = document.querySelectorAll('.parking-lot');

    // Remove 'selected' class and reset background color for all parking lots
    parkingLots.forEach(function (lot) {
        if (!lot.classList.contains('booked')) {
            lot.classList.remove('selected');
            lot.style.backgroundColor = 'white'; // Change background color to white for non-booked lots
        }
    });

    var selectedLot = document.getElementById('selected-lot');
    selectedLot.textContent = lotNumber;

    var hiddenInput = document.getElementById('hidden-lot');
    hiddenInput.value = lotNumber;

    var selectedParkingLot = document.querySelector('.parking-lot:nth-child(' + lotNumber + ')');
    selectedParkingLot.classList.add('selected');

    // Change the background color of the selected parking lot to red
    selectedParkingLot.style.backgroundColor = 'red';
}

    </script>
</body>

</html>

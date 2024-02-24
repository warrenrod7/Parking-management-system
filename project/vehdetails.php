<?php
if (isset($_GET['logout'])) {
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
            text-align: center;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-image: url('https://i.postimg.cc/Hk5V1FNJ/5218617.jpg');
            background-size: cover;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        nav {
            background-color: #444;
            padding: 10px;
        }

        h1 {
            color: #ffffff;
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

        #vehicle-list {
    margin-top: 50px; /* Adjust the top margin as needed */
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 50%; /* Set a fixed width for the container */
    margin: 0 auto; /* Center the container horizontally */
    text-align: center; /* Center the content within the container */
}

table {
    width: 100%; /* Use 100% width of the container */
    border-collapse: collapse;
    margin: 20px auto; /* Center the table horizontally */
}

th, td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #333;
    color: #fff;
    text-align: center; /* Center text in header cells */
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
        <a href="vehstored.php?logout">Log Out</a>
    </nav>
    <br><br><br>

    <div id="vehicle-list">
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }
        $phoneno = $_SESSION['phone'];
        echo "<h3 style='text-align:center;'>Your Details</h3>";
        echo "<h3>Phone Number : " . $phoneno . "</h3>";

        // Create connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dmqp";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $select_query = "select * from uservehicleview where phone=$phoneno";
        $result_select_query = mysqli_query($conn, $select_query);
        ?>

        <table>
            <tr>
                <th>Vehicle Number</th>
                <th>Vehicle Model</th>
            </tr>

            <?php
            $i = 1;
            while ($row_data = mysqli_fetch_assoc($result_select_query)) {
                $model = $row_data['Model'];
                $vehno = $row_data['VehicleID'];

                echo "<tr>";
                echo "<td>" . $vehno . "</td>";
                echo "<td>" . $model . "</td>";
                echo "</tr>";

                $i++;
            }
            ?>
        </table>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>

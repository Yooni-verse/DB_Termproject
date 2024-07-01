<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

$festival_query = "SELECT title FROM festival";
$festival_result = mysqli_query($connect, $festival_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $busname =  $_POST['bus-name'];
    $capacity = $_POST['capacity'];
    $startlocation = $_POST['start-location'];
    $drivername =$_POST['driver-name'];
    $driverphone = $_POST['driver-phone'];
	mysqli_query($connect, "set autocommit = 0");
	mysqli_query($connect, "set session transaction isolation level serializable");
	mysqli_query($connect, "begin");
	
	$sql = "INSERT INTO bus (title, bus_name, capacity, start_location, driver_name, driver_phone) VALUES ('$title', '$busname', '$capacity', '$startlocation', '$drivername', '$driverphone')";
	
	if (!mysqli_query($connect, $sql)) {
	    mysqli_query($connect, "rollback");
	    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	} 
	else {
	    mysqli_query($connect, "commit");
	    echo "<script>alert('Bus added successfully!'); window.location.href='bus_list.php';</script>";
	}
	mysqli_close($connect);


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Bus</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Register Bus</h1>
    <form name="form" action="bus_insert.php" method="POST">
        <p>
            <label for="title">Festival Title</label>
            <select id="title" name="title" required>
                <option value="">Select Festival</option>
                <?php
                if ($festival_result->num_rows > 0) {
                    while($row = $festival_result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['title']) . "'>" . htmlspecialchars($row['title']) . "</option>";
                    }
                }
                ?>
            </select>
        </p>
        <p>
            <label for="bus-name">Bus Name</label>
            <input type="text" id="bus-name" name="bus-name" required>
        </p>
        <p>
            <label for="capacity">Capacity</label>
            <input type="number" id="capacity" name="capacity" required>
        </p>
        <p>
            <label for="start-location">Start Location</label>
            <input type="text" id="start-location" name="start-location" required>
        </p>
        <p>
            <label for="driver-name">Driver Name</label>
            <input type="text" id="driver-name" name="driver-name" required>
        </p>
        <p>
            <label for="driver-phone">Driver Phone</label>
            <input type="text" id="driver-phone" name="driver-phone" required>
        </p>
        <p>
            <input type="submit" name="add-button" value="Send">
        </p>
    </form>
</div>

</body>
</html>

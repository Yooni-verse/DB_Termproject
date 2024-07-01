<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busid = $_POST['bus_id'];
    $title = $_POST['title'];
    $busname = $_POST['bus_name'];
    $capacity = $_POST['capacity'];
    $startlocation = $_POST['start_location'];
    $drivername =$_POST['driver_name'];
    $driverphone = $_POST['driver_phone'];
    
    mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");
    
    $sql = "UPDATE bus SET title = '$title', bus_name = '$busname', capacity = '$capacity', start_location = '$startlocation', driver_name = '$drivername', driver_phone = '$driverphone' WHERE bus_id = '$busid'";
    
    if (!mysqli_query($connect, $sql)) {
        mysqli_query($connect, "rollback");
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    } else {
        mysqli_query($connect, "commit");
        echo "<script>alert('Bus updated successfully!'); window.location.href='bus_list.php';</script>";
    }
    
    mysqli_close($connect);
}

$busid = $_GET['bus_id'];
$s_sql = "SELECT * FROM bus WHERE bus_id = '$busid'";
$result = mysqli_query($connect, $s_sql);
$bus = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bus</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], .form-group input[type="date"],{
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Bus</h2>
    <form name="form" method="POST" action="bus_update.php">
        <input type="hidden" name="bus_id" value="<?php echo ($bus['bus_id']); ?>">
        <div class="form-group">
            <label for="title">Festival Title</label>
            <input type="text" id="title" name="title" value="<?php echo ($bus['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="bus_name">Bus Name</label>
            <input type="text" id="bus_name" name="bus_name" value="<?php echo ($bus['bus_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" id="capacity" name="capacity" value="<?php echo ($bus['capacity']); ?>" required>
        </div>
        <div class="form-group">
            <label for="start_location">Start Location</label>
            <input type="text" id="start_location" name="start_location" value="<?php echo ($bus['start_location']); ?>" required>
        </div>
        <div class="form-group">
            <label for="driver_name">Driver Name</label>
            <input type="text" id="driver_name" name="driver_name" value="<?php echo ($bus['driver_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="driver_phone">Driver Phone</label>
            <input type="text" id="driver_phone" name="driver_phone" value="<?php echo ($bus['driver_phone']); ?>" required>
        </div>
        <div class="button-container">
            <button type="submit" class="button">Update</button>
        </div>
    </form>
</div>

</body>
</html>

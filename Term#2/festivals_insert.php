<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $URL = $_POST['URL'];
	mysqli_query($connect, "set autocommit = 0");
	mysqli_query($connect, "set session transaction isolation level serializable");
	mysqli_query($connect, "begin");
	
	$sql = "INSERT INTO festival (title, date, location, URL) VALUES ('$title', '$date', '$location', '$URL')";
	
	if (!mysqli_query($connect, $sql)) {
	    mysqli_query($connect, "rollback");
	    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	} else {
	    mysqli_query($connect, "commit");
	    echo "<script>alert('Festival registered successfully!'); window.location.href='festivals_list.php';</script>";
	}

	mysqli_close($connect);


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Festival</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 60px auto 0;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
		h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Register Festival</h1>
    <form name="form" action="festivals_insert.php" method="POST">
        <p>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </p>
        <p>
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
        </p>
        <p>
            <label for="location">Location</label>
            <input type="text" id="location" name="location" required>
        </p>
        <p>
            <label for="url">URL</label>
            <input type="text" id="url" name="URL" required>
        </p>
        <p>
            <input type="submit" name="add-button" value="Send">
        </p>
    </form>
</div>

</body>
</html>

<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stage_name = $_POST['stage_name'];
    $real_name = $_POST['real_name'];
    $album = $_POST['album'];
	mysqli_query($connect, "set autocommit = 0");
	mysqli_query($connect, "set session transaction isolation level serializable");
	mysqli_query($connect, "begin");
	$sql = "INSERT INTO artist (stage_name, real_name, album) VALUES ('$stage_name', '$real_name', '$album')";
	
	if (!mysqli_query($connect, $sql)) {
	    mysqli_query($connect, "rollback");
	    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	} else {
	    mysqli_query($connect, "commit");
	    echo "<script>alert('Artist added successfully!'); window.location.href='artist_list.php';</script>";
	}
	
	mysqli_close($connect);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Artist</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Add Artist</h1>
    <form name="form" action="artist_insert.php" method="POST">
        <p>
            <label for="stage_name">Stage Name</label>
            <input type="text" id="stage_name" name="stage_name" required>
        </p>
        <p>
            <label for="real_name">Real Name</label>
            <input type="text" id="real_name" name="real_name">
        </p>
        <p>
            <label for="album">Album</label>
            <input type="text" id="album" name="album" required>
        </p>
        <p>
            <input type="submit" name="add-button" value="Add Artist">
        </p>
    </form>
</div>

</body>
</html>

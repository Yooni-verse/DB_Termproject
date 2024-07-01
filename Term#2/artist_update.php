<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stage_name = $_POST['stage_name'];
    $real_name = $_POST['real_name'];
    $album = $_POST['album'];
	mysqli_query($connect, "set autocommit = 0");
	mysqli_query($connect, "set session transaction isolation level serializable");
	mysqli_query($connect, "begin");
	
	$sql = "UPDATE artist SET stage_name='$stage_name', real_name='$real_name', album='$album' WHERE stage_name='$stage_name'";
	
	if (!mysqli_query($connect, $sql)) {
	    mysqli_query($connect, "rollback");
	    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	} else {
	    mysqli_query($connect, "commit");
	    echo "<script>alert('Artist updated successfully!'); window.location.href='artist_list.php';</script>";
	}
	
	mysqli_close($connect);

	
}
$stage_name = $_GET['stage_name'];
$s_sql = "SELECT * FROM artist WHERE stage_name = '$stage_name'";
$result = mysqli_query($connect, $s_sql);
$artist = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artist</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Edit Artist</h1>
    <form name="form" action="artist_update.php" method="POST">
        <p>
            <label for="stage_name">Stage Name</label>
            <input type="text" id="stage_name" name="stage_name" value="<?php echo ($artist['stage_name']); ?>" required>
        </p>
        <p>
            <label for="real_name">Real Name</label>
            <input type="text" id="real_name" name="real_name" value="<?php echo ($artist['real_name']); ?>">
        </p>
        <p>
            <label for="album">Album</label>
            <input type="text" id="album" name="album" value="<?php echo ($artist['album']); ?>" required>
        </p>
        <p>
            <input type="submit" name="button1" value="Update Artist">
        </p>
    </form>
</div>

<script src="js/scripts.js"></script>
</body>
</html>

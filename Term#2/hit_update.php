<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if (isset($_GET['stage_name'])) {
    $stage_name = $_GET['stage_name'];
    $sql = "SELECT * FROM hit_song WHERE stage_name = '$stage_name'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $hit_songs = mysqli_fetch_assoc($result);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $song1 = $_POST['song1'];
    $song2 = $_POST['song2'];
    $song3 = $_POST['song3'];

    mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");

    $update_sql = "UPDATE hit_song SET song1 = '$song1', song2 = '$song2', song3 = '$song3' WHERE stage_name = '$stage_name'";

    if (!mysqli_query($connect, $update_sql)) {
        mysqli_query($connect, "rollback");
        echo "Error: " . $update_sql . "<br>" . mysqli_error($connect);
    } 
    else {
        mysqli_query($connect, "commit");
        echo "<script>alert('Hit songs updated successfully!'); window.location.href='hit_song.php?stage_name=" . urlencode($stage_name) . "';</script>";
    }

    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Hit Songs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Update Hit Songs for <?php echo ($stage_name); ?></h1>
    <form method="POST" action="hit_update.php?stage_name=<?php echo urlencode($stage_name); ?>">
        <div class="form-group">
            <label for="song1">Song 1</label>
            <input type="text" id="song1" name="song1" value="<?php echo ($hit_songs['song1']); ?>" required>
        </div>
        <div class="form-group">
            <label for="song2">Song 2</label>
            <input type="text" id="song2" name="song2" value="<?php echo ($hit_songs['song2']); ?>" required>
        </div>
        <div class="form-group">
            <label for="song3">Song 3</label>
            <input type="text" id="song3" name="song3" value="<?php echo ($hit_songs['song3']); ?>" required>
        </div>
        <button type="submit" class="button">Update Hit Songs</button>
    </form>
</div>
</body>
</html>

<?php
$stage_name = $_GET['stage_name'];

$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stage_name = $_POST['stage_name'];
    $song1 = $_POST['song1'];
    $song2 = $_POST['song2'];
    $song3 = $_POST['song3'];

    mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");

    $sql = "INSERT INTO hit_song (stage_name, song1, song2, song3) VALUES ('$stage_name', '$song1', '$song2', '$song3')";

    if (!mysqli_query($connect, $sql)) {
        mysqli_query($connect, "rollback");
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    } else {
        mysqli_query($connect, "commit");
        echo "<script>alert('Hit songs added successfully!'); window.location.href='artist_list.php';</script>";
    }

    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hit Songs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 100px auto 0;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<div class="container">
    <h1>Add Hit Songs for <?php echo ($stage_name); ?></h1>
    <form name="form" action="hit_add.php" method="POST">
        <input type="hidden" name="stage_name" value="<?php echo ($stage_name); ?>">
        <p>
            <label for="song1">Song 1</label>
            <input type="text" id="song1" name="song1" required>
        </p>
        <p>
            <label for="song2">Song 2</label>
            <input type="text" id="song2" name="song2" required>
        </p>
        <p>
            <label for="song3">Song 3</label>
            <input type="text" id="song3" name="song3" required>
        </p>
        <p>
            <input type="submit" name="button" value="Add Hit Songs">
        </p>
    </form>
</div>

</body>
</html>

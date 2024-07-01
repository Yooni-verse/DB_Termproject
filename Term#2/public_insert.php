<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $trans_name = $_POST['trans_name'];
    $trans_type = $_POST['trans_type'];

    mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");

    $sql = "INSERT INTO public_trans (title, trans_name, trans_type) VALUES ('$title', '$trans_name', '$trans_type')";
        mysqli_query($connect, "rollback");
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    if (!mysqli_query($connect, $sql)) {
   } else {
	    mysqli_query($connect, "commit");
        echo "<script>alert('Public transportation added successfully!'); window.location.href='festivals.php?title=" . urlencode($title) . "';</script>";
  
    }

    mysqli_close($connect);
}

$title = "";
if (isset($_GET['title'])) {
    $title = $_GET['title'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Public Transportation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Add Public Transportation for <?php echo ($title); ?></h1>
    <form action="public_insert.php" method="POST">
        <input type="hidden" name="title" value="<?php echo ($title); ?>">
        <p>
            <label for="trans_name">Transportation Name</label>
            <input type="text" id="trans_name" name="trans_name" required>
        </p>
        <p>
            <label for="trans_type">Transportation Type</label>
            <input type="text" id="trans_type" name="trans_type" required>
        </p>
        <p>
            <button type="submit" class="add-button">Add Transportation</button>
        </p>
    </form>
</div>

</body>
</html>

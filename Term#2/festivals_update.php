<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $URL = $_POST['URL'];
	mysqli_query($connect, "set autocommit = 0");
	mysqli_query($connect, "set session transaction isolation level serializable");
	mysqli_query($connect, "begin");
	
	$sql = "UPDATE festival SET title = '$title', date = '$date', location = '$location', URL = '$URL' WHERE title = '$title'";
	
	if (!mysqli_query($connect, $sql)) {
	    mysqli_query($connect, "rollback");
	    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	} else {
	    mysqli_query($connect, "commit");
	    echo "<script>alert('Festival updated successfully!'); window.location.href='festivals_list.php';</script>";
	}
	
	mysqli_close($connect);


}

$title = $_GET['title'];
$s_sql = "SELECT title, date, location, URL FROM festival WHERE title = '$title'";
$result = mysqli_query($connect, $s_sql);
$festival = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>페스티벌 수정</title>
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
    <h2>페스티벌 수정</h2>
    <form action="festivals_update.php" method="post">
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="<?php echo ($festival['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date">날짜</label>
            <input type="date" id="date" name="date" value="<?php echo ($festival['date']); ?>" required>
        </div>
        <div class="form-group">
            <label for="location">장소</label>
            <input type="text" id="location" name="location" value="<?php echo ($festival['location']); ?>" required>
        </div>
        <div class="form-group">
            <label for="URL">URL</label>
            <input type="text" id="URL" name="URL" value="<?php echo ($festival['URL']); ?>" required>
        </div>
        <div class="button-container">
            <button type="submit" class="button">저장</button>
            <a href="festivals_list.php" class="button">취소</a>
        </div>
    </form>
</div>

</body>
</html>

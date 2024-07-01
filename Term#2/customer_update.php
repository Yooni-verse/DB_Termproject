<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id =  $_POST['id'];
    $name = $_POST['name'];
    $birth = $_POST['birth'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $residence = $_POST['residence'];
	mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");
    $sql = "UPDATE customer SET name='$name', birth='$birth', sex='$sex', age='$age', residence='$residence' WHERE id='$id'";
    if (!mysqli_query($connect, $sql)) {
        mysqli_query($connect, "rollback");
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    } else {
    	mysqli_query($connect, "commit");
        echo "<script>alert('Customer updated successfully!'); window.location.href='customer_list.php';</script>";
    }
}
$stage_name = $_GET['id'];
$s_sql = "SELECT * FROM customer WHERE id = '$stage_name'";
$result = mysqli_query($connect, $s_sql);
$customer = mysqli_fetch_assoc($result);
mysqli_close($connect);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Edit Customer</h1>
    <form name="form" action="customer_update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo ($customer['id']); ?>">
        <p>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo ($customer['name']); ?>" required>
        </p>
        <p>
            <label for="birth">Birth Date</label>
            <input type="date" id="birth" name="birth" value="<?php echo ($customer['birth']); ?>" required>
        </p>
        <p>
            <label for="sex">Sex</label>
            <select id="sex" name="sex" required>
                <option value="Male" <?php if ($customer['sex'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($customer['sex'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>
        </p>
        <p>
            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="<?php echo ($customer['age']); ?>" required>
        </p>
        <p>
            <label for="residence">Residence</label>
            <input type="text" id="residence" name="residence" value="<?php echo ($customer['residence']); ?>" required>
        </p>

        <p>
            <input type="submit" name="button1" value="Update Customer">
        </p>
    </form>
</div>

<script src="js/scripts.js"></script>
</body>
</html>

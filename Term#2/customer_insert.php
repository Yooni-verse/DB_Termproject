<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $birth = $_POST['birth'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $residence = $_POST['residence'];

	mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");
    $sql = "INSERT INTO customer (name, birth, sex, age, residence, num) VALUES ('$name', '$birth', '$sex', '$age', '$residence', 0)";

    if (!mysqli_query($connect, $sql)) {
        mysqli_query($connect, "rollback");
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);

    } else {
        mysqli_query($connect, "commit");
        echo "<script>alert('Customer added successfully!'); window.location.href='customer_list.php';</script>";
    }

    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<div class="container">
    <h1>Add Customer</h1>
    <form name="form" action="customer_insert.php" method="POST">
        <p>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </p>
        <p>
            <label for="birth">Birth Date</label>
            <input type="date" id="birth" name="birth" required>
        </p>
        <p>
            <label for="sex">Sex</label>
            <select id="sex" name="sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </p>
        <p>
            <label for="age">Age</label>
            <input type="number" id="age" name="age" required>
        </p>
        <p>
            <label for="residence">Residence</label>
            <input type="text" id="residence" name="residence" required>
        </p>
        <p>
            <input type="submit" name="add-button" value="Add Customer">
        </p>
    </form>
</div>

</body>
</html>

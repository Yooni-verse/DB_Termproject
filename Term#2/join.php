<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $festival_title = $_POST['festival_title'];

    $check_sql = "SELECT * FROM participate WHERE id='$customer_id' AND title='$festival_title'";
    $check_result = mysqli_query($connect, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('This participation already exists!'); window.location.href='participate.php?id=$customer_id';</script>";
    } 
    else {
    mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");

    $insert_sql = "INSERT INTO participate (title, id) VALUES ('$festival_title', '$customer_id')";

    if (mysqli_query($connect, $insert_sql)) {
        mysqli_query($connect, "commit");
        echo "<script>alert('Participation added successfully!'); window.location.href='participate.php?id=$customer_id';</script>";
    } 
    else {
        mysqli_query($connect, "rollback");
        echo "Error: " . $insert_sql . "<br>" . mysqli_error($connect);
    	}

    }
    mysqli_close($connect);
}
?>

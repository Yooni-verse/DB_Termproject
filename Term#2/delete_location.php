<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];

    $customer_sql = "SELECT residence FROM customer WHERE id = '$customer_id'";
    $customer_result = mysqli_query($connect, $customer_sql);
    $customer = mysqli_fetch_assoc($customer_result);
    $customer_residence = $customer['residence'];
	mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");
    $sql = "DELETE p
        FROM participate p
        JOIN festival f ON p.title = f.title
        WHERE p.id = '$customer_id' AND f.location != '$customer_residence'";
    if (!mysqli_query($connect, $sql)) {
        mysqli_query($connect, "rollback");
        echo "Error: " . mysqli_error($connect);
    } else {
        mysqli_query($connect, "commit");
        echo "<script>alert('participations deleted successfully!'); window.location.href='participate.php?id=$customer_id';</script>";
    }

    mysqli_close($connect);
}
?>

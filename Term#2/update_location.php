<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];

    $customer_sql = "SELECT residence FROM customer WHERE id = '$customer_id'";
    $customer_result = mysqli_query($connect, $customer_sql);
    $customer = mysqli_fetch_assoc($customer_result);
    $customer_residence = $customer['residence'];

    $sql = "INSERT INTO participate (title, id)
        SELECT f.title, '$customer_id'
        FROM festival f
        LEFT JOIN participate p ON f.title = p.title AND p.id = '$customer_id'
        WHERE f.location = '$customer_residence' AND p.title IS NULL";

    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Matching participations added successfully!'); window.location.href='participate.php?id=$customer_id';</script>";
    } else {
        echo "Error: " . mysqli_error($connect);
    }

    mysqli_close($connect);
} 
?>

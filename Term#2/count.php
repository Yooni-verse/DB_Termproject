<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

mysqli_query($connect, "set autocommit = 0");
mysqli_query($connect, "set session transaction isolation level serializable");
mysqli_query($connect, "begin");

$sql = "UPDATE 
	customer c JOIN (
        SELECT id, COUNT(*) as num
        FROM participate
        GROUP BY id
    ) p ON c.id = p.id
    SET c.num = p.num;";

if (!mysqli_query($connect, $sql)) {
    mysqli_query($connect, "rollback");
    echo "Error updating participation counts: " . mysqli_error($connect);

} else {
    mysqli_query($connect, "commit");
    echo "<script>alert('Participation counts updated successfully!'); window.location.href='customer_list.php';</script>";
}

mysqli_close($connect);
?>

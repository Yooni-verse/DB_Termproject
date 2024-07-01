<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

$busid = $_GET['bus_id'];
mysqli_query($connect, "set autocommit = 0");
mysqli_query($connect, "set session transaction isolation level serializable");
mysqli_query($connect, "begin");

$sql = "DELETE FROM bus WHERE bus_id = '$busid'";

if (!mysqli_query($connect, $sql)) {
    mysqli_query($connect, "rollback");
    echo "Error deleting bus: " . mysqli_error($connect);
} else {
    mysqli_query($connect, "commit");
    echo "<script>alert('Bus deleted successfully!'); window.location.href='bus_list.php';</script>";
}

mysqli_close($connect);

echo "<script>alert('Bus deleted successfully'); window.location.href='bus_list.php';</script>";

?>

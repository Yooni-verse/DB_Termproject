<?php include("header.php"); ?>  
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

$title = $_GET['title'];

mysqli_query($connect, "set autocommit = 0");
mysqli_query($connect, "set session transaction isolation level serializable");
mysqli_query($connect, "begin");

$participate_sql = "DELETE FROM participate WHERE title = '$title'";
$appear_sql = "DELETE FROM appear WHERE title = '$title'";

if (!mysqli_query($connect, $participate_sql) || !mysqli_query($connect, $appear_sql)) {
    mysqli_query($connect, "rollback");
    echo "Error deleting festival: " . mysqli_error($connect);
} else {
    $sql = "DELETE FROM festival WHERE title = '$title'";
    if (!mysqli_query($connect, $sql)) {
        mysqli_query($connect, "rollback");
        echo "Error deleting festival: " . mysqli_error($connect);
    } else {
        mysqli_query($connect, "commit");
        echo "<script>alert('Festival deleted successfully'); window.location.href='festivals_list.php';</script>";
    }
}

mysqli_close($connect);
?>

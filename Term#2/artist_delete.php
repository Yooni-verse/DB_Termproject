<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

$stage_name = $_GET['stage_name'];
mysqli_query($connect, "set autocommit = 0");
mysqli_query($connect, "set session transaction isolation level serializable");
mysqli_query($connect, "begin");
$appear_sql = "DELETE FROM appear WHERE stage_name = '$stage_name'";
$artist_sql = "DELETE FROM artist WHERE stage_name = '$stage_name'";

if (mysqli_query($connect, $appear_sql)) {
    if (mysqli_query($connect, $artist_sql)) {
        mysqli_query($connect, "commit");
        echo "<script>alert('Artist deleted successfully'); window.location.href='artist_list.php';</script>";
    } else {
        mysqli_query($connect, "rollback");
        echo "Error deleting artist: " . mysqli_error($connect);
    }
} else {
    mysqli_query($connect, "rollback");
    echo "Error deleting appear: " . mysqli_error($connect);
}
mysqli_close($connect);

?>

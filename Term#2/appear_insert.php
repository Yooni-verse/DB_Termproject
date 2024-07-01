<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$festival_title = $_POST['festival_title'];
    $stage_name = $_POST['stage_name'];
	mysqli_query($connect, "set autocommit = 0");
	mysqli_query($connect, "set session transaction isolation level serializable");
	mysqli_query($connect, "begin");
	
	$sql = "INSERT INTO appear (title, stage_name) VALUES ('$festival_title', '$stage_name')";
	if (!mysqli_query($connect, $sql)) {
	    mysqli_query($connect, "rollback");
	    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	} else {
	    mysqli_query($connect, "commit");
	    echo "<script>alert('Artist added to festival successfully!'); window.location.href='appear.php?title=" . urlencode($festival_title) . "';</script>";
	}
	
	mysqli_close($connect);

}
?>

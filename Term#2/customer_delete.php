<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
	mysqli_query($connect, "set autocommit = 0");
    mysqli_query($connect, "set session transaction isolation level serializable");
    mysqli_query($connect, "begin");
    $p_sql = "DELETE FROM participate WHERE id = '$id'";
    $sql = "DELETE FROM customer WHERE id = '$id'";
    if (mysqli_query($connect, $p_sql)) {
    	    if (mysqli_query($connect, $sql)) {
		        mysqli_query($connect, "commit");
		        echo "<script>alert('Customer deleted successfully!'); window.location.href='customer_list.php';</script>";
		    } else {
		        mysqli_query($connect, "rollback");
		        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
		    }
    } 
    else {
	    mysqli_query($connect, "rollback");
	    echo "Error: Customer ID not specified.";
    }
}
mysqli_close($connect);
?>
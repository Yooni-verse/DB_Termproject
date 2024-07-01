<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    if(empty($search_query)){
		$sql = "SELECT * FROM bus";
    }
    else{
	    $sql = "SELECT b.title, b.bus_name, b.capacity, b.start_location, b.driver_name, b.driver_phone
        FROM festival f
        NATURAL JOIN bus b
        WHERE f.title = '$search_query'";
    }
}
else{
	$sql = "SELECT * FROM bus";

}
$result = mysqli_query($connect, $sql);
mysqli_close($connect);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Bus List</h1>
        <a href="bus_insert.php" class="add-button">Add New Bus</a>
    </div>
    <form class="search-form" method="GET" action="bus_list.php">
        <input type="text" name="search" placeholder="Search for bus..." value="<?php echo ($search_query); ?>">
        <button type="submit" class="search-button">Search</button>
    </form>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Title</th>
            <th>Bus Name</th>
            <th>Capacity</th>
            <th>Start Location</th>
            <th>Driver Name</th>
            <th>Driver Phone</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
	            echo "<td>{$row['title']}</td>";
	            echo "<td>{$row['bus_name']}</td>";
	            echo "<td>{$row['capacity']}</td>";
	            echo "<td>{$row['start_location']}</td>";
	            echo "<td>{$row['driver_name']}</td>";
	            echo "<td>{$row['driver_phone']}</td>";
                echo "<td><a href='bus_update.php?bus_id=" . urlencode($row["bus_id"]) . "' class='button small'>Edit</a> | <a href='bus_delete.php?bus_id=" . urlencode($row["bus_id"]) . "' class='delete-button'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>운행정보가 없습니다.</tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

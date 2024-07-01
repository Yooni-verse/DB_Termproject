<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    if(empty($search_query)){
		$sql = "SELECT * FROM customer";
    }
    else{
	    $sql = "SELECT * FROM customer WHERE id = '$search_query'";
    }
}
else{
	$sql = "SELECT * FROM customer";

}
$result = mysqli_query($connect, $sql);
mysqli_close($connect);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <style>
        .edit-button, .delete-button, .participate-button {
            padding: 4px 8px;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            text-align: center;
        }
        .edit-button {
            background-color: #5f90b0;
        }
        .delete-button {
            background-color: #ff4d4d;
        }
        .participate-button {
            background-color: #4CAF50;
        }
    </style>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<div class="container">
    <div class="header">
        <h1>Customer List</h1>
        <a href="customer_insert.php" class="add-button">Add New Customer</a>
    </div>
    <form class="search-form" method="GET" action="customer_list.php">
        <input type="text" name="search" placeholder="Search for customers..." value="<?php echo ($search_query); ?>">
        <button type="submit" class="search-button">Search</button>
    </form>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Birth</th>
            <th>Sex</th>
            <th>Age</th>
            <th>Residence</th>
            <th>Num</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row["id"]}</td>";
                echo "<td>{$row["name"]}</td>";
                echo "<td>{$row["birth"]}</td>";
                echo "<td>{$row["sex"]}</td>";
                echo "<td>{$row["age"]}</td>";
                echo "<td>{$row["residence"]}</td>";
                echo "<td>{$row["num"]}</td>";
                echo "<td>
                        <a href='customer_update.php?id=" . urlencode($row["id"]) . "' class='edit-button'>Edit</a> 
                        <a href='customer_delete.php?id=" . urlencode($row["id"]) . "' class='delete-button'>Delete</a>
                        <a href='participate.php?id=" . urlencode($row["id"]) . "' class='participate-button'>Participate</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

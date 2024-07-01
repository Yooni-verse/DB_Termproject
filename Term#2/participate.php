<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT p.title, f.date, f.location, f.URL 
            FROM participate p 
            JOIN festival f ON p.title = f.title 
            WHERE p.id = '$id'";
    $result = mysqli_query($connect, $sql);

    $festival_sql = "SELECT title FROM festival";
    $festival_result = mysqli_query($connect, $festival_sql);    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participate List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Participate List</h1>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Festival Title</th>
            <th>Date</th>
            <th>Location</th>
            <th>URL</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row["title"]}</td>";
                echo "<td>{$row["date"]}</td>";
                echo "<td>{$row["location"]}</td>";
                echo "<td><a href='" . ($row["URL"]) . "' target='_blank'>" . ($row["URL"]) . "</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>

    <div class="form-container">
        <form action="join.php" method="POST">
            <input type="hidden" name="customer_id" value="<?php echo ($id); ?>">
            <select name="festival_title" required>
                <option value="">Select Festival</option>
                <?php while($festival = mysqli_fetch_assoc($festival_result)): ?>
                    <option value="<?php echo ($festival['title']); ?>"><?php echo ($festival['title']); ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="add-button">Add Participation</button>
        </form>
    </div>
    <div class="form-container">
        <form action="update_location.php" method="POST">
            <input type="hidden" name="customer_id" value="<?php echo ($id); ?>">
            <button type="submit" class="add-button">Update by Location</button>
        </form>
    </div>
    <div class="form-container">
	    <form action="delete_location.php" method="POST">
	        <input type="hidden" name="customer_id" value="<?php echo ($id); ?>">
	        <button type="submit" class="delete-button">Delete by Location</button>
	    </form>
	</div>
    <div class="form-container">
	    <form action="count.php" method="POST">
	        <input type="hidden" name="customer_id" value="<?php echo ($id); ?>">
	        <button type="submit" class="add-button">Update Count</button>
	    </form>
	</div>
</div>

</body>
</html>

<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

$search_query = "";
$sql = "SELECT * FROM artist";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $sql .= " WHERE stage_name LIKE '%$search_query%'";
}
$result = mysqli_query($connect, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist List</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .edit-button, .delete-button, .hits-button, .festivals-button {
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
        .hits-button {
            background-color: #4CAF50;
        }
        .festivals-button {
            background-color: #7401DF;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Artist List</h1>
        <a href="artist_insert.php" class="add-button">Add New Artist</a>
    </div>
    
    <form class="search-form" method="GET" action="artist_list.php">
        <input type="text" name="search" placeholder="Search for artist..." value="<?php echo ($search_query); ?>">
        <button type="submit" class="search-button">Search</button>
    </form>
    
    <table class="table table-striped table-bordered">
        <tr>
            <th>Stage Name</th>
            <th>Real Name</th>
            <th>Album</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='hit_song.php?stage_name=" . urlencode($row["stage_name"]) . "'>" . ($row["stage_name"]) . "</a></td>";
                echo "<td>{$row["real_name"]}</td>";
                echo "<td>{$row["album"]}</td>";
                echo "<td>
                        <a href='artist_update.php?stage_name=" . urlencode($row["stage_name"]) . "' class='edit-button'>Edit</a> 
                        <a href='artist_delete.php?stage_name=" . urlencode($row["stage_name"]) . "' class='delete-button'>Delete</a>
                        <a href='hit_add.php?stage_name=" . urlencode($row["stage_name"]) . "' class='hits-button'>Add Hits</a>
                        <a href='artist_appear.php?stage_name=" . urlencode($row["stage_name"]) . "' class='festivals-button'>View Festivals</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
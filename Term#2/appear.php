<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if (isset($_GET['title'])) {
    $title =  $_GET['title'];
    
    $sql = "SELECT stage_name FROM appear WHERE title = '$title'";
    $result = mysqli_query($connect, $sql);
    $artist_sql = "SELECT stage_name FROM artist";
    $artist_result = mysqli_query($connect, $artist_sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appear List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Appear List for <?php echo ($title); ?></h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Stage Name</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row["stage_name"]}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='1'>No appear found</td></tr>";
        }
        ?>
    </table>

    <div class="form-container">
        <form action="appear_insert.php" method="POST">
            <input type="hidden" name="festival_title" value="<?php echo ($title); ?>">
            <select name="stage_name" required>
                <option value="">Select Artist</option>
                <?php while($artist = mysqli_fetch_assoc($artist_result)): ?>
                    <option value="<?php echo ($artist['stage_name']); ?>"><?php echo ($artist['stage_name']); ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="add-button">Add Participation</button>
        </form>
    </div>
</div>

</body>
</html>

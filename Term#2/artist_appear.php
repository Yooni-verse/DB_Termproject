<?php include("header.php"); ?>
<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if (isset($_GET['stage_name'])) {
    $stage_name = $_GET['stage_name'];
    $sql = "SELECT f.title, f.date, f.location, f.URL 
            FROM appear a 
            JOIN festival f ON a.title = f.title 
            WHERE a.stage_name = '$stage_name'";
    $result = mysqli_query($connect, $sql);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festivals for <?php echo ($stage_name); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Festivals for <?php echo ($stage_name); ?></h1>
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
</div>

</body>
</html>

<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");
$title = $_GET['title'];
$customer_id = $_GET['customer_id'];

$query = "SELECT b.* FROM bus b 
          JOIN customer c ON b.start_location = c.residence 
          WHERE c.id = '$customer_id' AND b.title = '$title'";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Bus Results</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="results-container">
        <h2>Bus Information</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Bus ID</th>
                    <th>Bus Name</th>
                    <th>Capacity</th>
                    <th>Start Location</th>
                    <th>Driver Name</th>
                    <th>Driver Phone</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['bus_id']; ?></td>
                        <td><?php echo $row['bus_name']; ?></td>
                        <td><?php echo $row['capacity']; ?></td>
                        <td><?php echo $row['start_location']; ?></td>
                        <td><?php echo $row['driver_name']; ?></td>
                        <td><?php echo $row['driver_phone']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No bus information available for this customer and festival.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

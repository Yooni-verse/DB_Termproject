<?php
$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");

if (isset($_GET['stage_name'])) {
    $stage_name = $_GET['stage_name'];
    $sql = "SELECT * FROM hit_song WHERE stage_name = '$stage_name'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $hit_songs = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hit Songs</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<div class="container">
    <h1>Hit Songs for <?php echo ($stage_name); ?></h1>
    <?php if ($hit_songs): ?>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Song 1</th>
                <th>Song 2</th>
                <th>Song 3</th>
            </tr>
            <tr>
                <td><?php echo ($hit_songs["song1"]); ?></td>
                <td><?php echo ($hit_songs["song2"]); ?></td>
                <td><?php echo ($hit_songs["song3"]); ?></td>
            </tr>
        </table>
        <a href="hit_update.php?stage_name=<?php echo urlencode($stage_name); ?>" class="button">Update Hit Songs</a>
        <a href="artist_list.php" class="button">돌아가기</a>

    <?php else: ?>
        <p>No hit songs found for this artist.</p>
    <?php endif; ?>
</div>

</body>
</html>

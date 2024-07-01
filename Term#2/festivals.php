<? include ("header.php"); ?> 
<?php

$connect = mysqli_connect("localhost", "db2022320053", "sjysjy2002@korea.ac.kr", "db2022320053");
$title = $_GET['title'];

$sql = "SELECT title, date, location, URL FROM festival WHERE title = '$title'";
$festival_result = mysqli_query($connect, $sql);
$festival = mysqli_fetch_assoc($festival_result);    

$public_trans_sql = "SELECT trans_name, trans_type FROM public_trans WHERE title = '$title'";
$public_trans_result = mysqli_query($connect, $public_trans_sql);  


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($festival['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            flex-wrap: wrap;
        }
        .festival-image-container {
            width: 100%;
            display: flex;
            justify-content: center; 
            margin-bottom: 20px; 
        }
        .festival-image {
            width: 40%;
            max-width: 500px;
        }
        .festival-details {
            flex: 1;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .festival-details th, .festival-details td {
            padding: 10px;
            text-align: left;
        }
        .festival-details th {
            background-color: #f4f4f4;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
            width: 100%;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="festival-image-container">
        <img src="images/banner.png" alt="Festival Image" class="festival-image">
    </div>
    
    <div class="festival-details">
        <table>
            <tr>
                <th>제목</th>
                <td><?php echo ($festival['title']); ?></td>
            </tr>
            <tr>
                <th>날짜</th>
                <td><?php echo ($festival['date']); ?></td>
            </tr>
            <tr>
                <th>장소</th>
                <td><?php echo ($festival['location']); ?></td>
            </tr>
            <tr>
                <th>URL</th>
                <td><a href="<?php echo ($festival['URL']); ?>" target="_blank"><?php echo ($festival['URL']); ?></a></td>
            </tr>
        </table>
    </div>

    <div class="button-container">
        <a href="festivals_list.php" class="button">돌아가기</a>
        <a href="festivals_update.php?title=<?php echo urlencode($festival['title']); ?>" class="button">수정하기</a> 
        <a href="appear.php?title=<?php echo urlencode($festival['title']); ?>" class="button">아티스트 관리</a>
        <a href="public_insert.php?title=<?php echo urlencode($festival['title']); ?>" class="button">대중교통 추가</a>
    </div>
    <div class="search-container">
        <form action="search_bus.php" method="GET">
            <input type="hidden" name="title" value="<?php echo ($festival['title']); ?>">
            <input type="text" name="customer_id" placeholder="Enter Customer ID" required>
            <button type="submit">Search Bus</button>
        </form>
    </div>


    <div class="results-container">
        <h2>Public Transportation</h2>
        <?php if ($public_trans_result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Transportation Name</th>
                    <th>Transportation Type</th>
                </tr>
                <?php while($row = $public_trans_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['trans_name']; ?></td>
                        <td><?php echo $row['trans_type']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No public transportation information available.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

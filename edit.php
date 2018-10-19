<?php
require_once('dbconnect.php');

$feed_id = $_GET["feed_id"];

if (!empty($_POST)) {
    $update_sql = "UPDATE `feeds` SET `feed` = ? WHERE `feeds`.`id` = ?";
    $data = [$_POST["feed"],$feed_id];
    $stmt = $dbh->prepare($update_sql);
    $stmt->execute($data);

    header("Location: timeline.php");
    exit();
}

$sql = "SELECT `feeds`.*,`users`.`name`,`users`.`img_name` FROM `feeds` LEFT JOIN `users` ON `feeds`.`user_id`=`users`.`id` WHERE `feeds`.`id`=$feed_id";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$feed = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Learn SNS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <form class="form-group" method="post">
                    <img src="user_profile_img/<?= $feed["img_name"]; ?>" width="60">
                    <?= $feed["name"]; ?><br>
                    <?= $feed["created"]; ?><br>
                    <textarea name="feed" class="form-control"><?= $feed["feed"]; ?></textarea>
                    <input type="submit" value="更新" class="btn btn-warning btn-xs">
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
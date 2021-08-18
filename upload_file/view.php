<?php
$dbh = new PDO("mysql:host=localhost;dbname=google_login", "root", "");
$id = isset($_GET['id'])? $_GET['id'] : "";

$stat = $dbh -> prepare("SELECT * from data where id=?");
$stat->bindParam(1,$id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:' .$row['type']);
echo $row['data'];
?>
<?php
require_once ("db_connection.php");
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$commentSenderName = isset($_POST['name']) ? $_POST['name'] : "";
$date = date('Y-m-d H:i:s');
// $audio_id =  intval($_GET['audio_id']);
$audio_id = isset($_POST['audio_id']) ? $_POST['audio_id'] : "";

$sql = "INSERT INTO tbl_comment(parent_comment_id,comment,comment_sender_name,date,audio_id) VALUES ('" . $commentId . "','" . $comment . "','" . $commentSenderName . "','" . $date . "', '" . $audio_id . "')";

$result = mysqli_query($db_connection, $sql);

if (! $result) {
    $result = mysqli_error($db_connection);
}
echo $result;
?>

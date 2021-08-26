<?php
require_once ("db_connection.php");

$sql = "SELECT * FROM tbl_comment WHERE audio_id = ".$_GET['audio_id']." ORDER BY parent_comment_id asc, comment_id asc ";

$result = mysqli_query($db_connection, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);

mysqli_close($db_connection);
echo json_encode($record_set);
?>
<?php
include('../db_connection.php');
$msg = "";

if (isset($_POST['upload'])) {

	// Get text
	$Video_title = mysqli_real_escape_string($db_connection, $_POST['video_title']);
	$Video_link = mysqli_real_escape_string($db_connection, $_POST['video_link']);
	
	
	
	$sql = "INSERT INTO video (video_title, video_link) VALUES ('$Video_title', '$Video_link')";
	// execute query
	mysqli_query($db_connection, $sql);
  
}
?>
<html>
    <head></head>
    <body>

    <form method="POST" action="index.php" enctype="multipart/form-data">
  
  	<div>
	  <input id="video_title" name="video_title" placeholder="title">
	  <input id="video_link" name="video_link" placeholder="Video ID not Link">

  	</div>
  	<div>
  		<button type="submit" name="upload">POST</button>
  	</div>
  </form>
</div>







   </body>
 </html>
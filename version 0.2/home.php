<?php
require 'db_connection.php';


if(!isset($_SESSION['login_id'])){
    header('Location: login.php');
    exit;
}


$id = $_SESSION['login_id'];



$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}
else{
    header('Location: logout.php');
    exit;
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $user['name']; ?></title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7ff;
            padding: 10px;
            margin: 0;
        }
        ._container{
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #cccccc;
            border-radius: 2px;
        }

        ._img{
            overflow: hidden;
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        ._img > img{
            width: 100px;
            min-height: 100px;
        }
        ._info{
            text-align: center;
        }
        ._info h1{
            margin:10px 0;
            text-transform: capitalize;
        }
        ._info p{
            color: #555555;
        }
        ._info a{
            display: inline-block;
            background-color: #E53E3E;
            color: #fff;
            text-decoration: none;
            padding:5px 10px;
            border-radius: 2px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="_container">
        <div class="_img">
            <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
        </div>
        <div class="_info">
            <h1><?php echo $user['name']; ?></h1>
            <p><?php echo $user['email']; ?></p>
            <a href="logout.php">Logout</a>
        </div>
    </div>
 

<br>

<?php

$sql = "SELECT id, video_title, video_link FROM video";
$result = $db_connection->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) { 
	 
	  
 echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'. $row["video_link"].'"></iframe>';

}
} else {
  echo "0 results";
}
?>



<div>
        <h1>Audio</h1>
        <form action="Upload_audio.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="audioFile" required /></input>
        <br>
        <input type="text" name="audio_title" placeholder="Title" required></input>
        <br>
        <textarea placeholder="Describe yourself here..." type="text" name="description1" rows="4" cols="50" required></textarea>
        
        <input type="submit"  value="upload_Audio" name="save_audio" />
        </form>
        <div>
           
        <?php

    $conn=mysqli_connect('localhost', 'root', '', 'google_login');
    if(!$conn){
        die('ser connected');

    }
    
    $query="select * from data WHERE `user_email` = '".$_SESSION['email']."' ";
    $r=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($r)){
       echo '<p style="border-style: dotted;  border-radius: 8px;
       height: 50px;
  width: 55%;
       background-color: lightblue;">';
      
       echo ' At '.$row['Time'].' '.$user['name'].' sent '.$row['name'].' here is the file:';
       echo '<a  href="play.php?name='.$row['type'].'">'.$row['type'].'</a>';
       echo "</p>";
    
       
   }
  
   mysqli_close($conn);  

   ?>
  
</body>
</html>
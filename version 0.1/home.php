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
    <?php
        $_SESSION['email'] = $user['email'];
       

        $dbh = new PDO("mysql:host=localhost;dbname=google_login", "root", "");
        if(isset($_POST['btn'])){
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
     $user_email = $_SESSION['email'];

        $stmt = $dbh -> prepare("insert into data values('',?,?,?,?)");
        $stmt->bindParam(1,$name);
        $stmt->bindParam(2,$type);
        $stmt->bindParam(3,$data);
        $stmt->bindParam(4,$user_email);
        $stmt->execute();
    
        }
        
        ?>

    <form method="post" enctype="multipart/form-data">
  Select your code to upload:
  <input type="file" name="myfile" id="myfile"/>
 <button name="btn">Upload file</button>
</form>
   <?php
   $stat = $dbh -> prepare("SELECT * FROM `data` WHERE `user_email` = '".$_SESSION['email']."' ");

   $stat->execute();
   while ($row = $stat->fetch()){
       echo "<li><a target='_blank' href='upload_file/view.php?id=".$row['id']."'>".$row['name']."</a></li>";
   }
   ?>
   
 

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
<iframe src="https://www.youtube.com/embed/bWPMSSsVdPk" >

</iframe>

</body>
</html>
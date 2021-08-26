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
$_SESSION['email'] = $user['email'];

echo $user['name'];
    
if(isset($_POST['save_audio']) && $_POST['save_audio']=="upload_Audio"){
    
    $name = $_POST['audio_title'];
    $description = $_POST['description1'];

    $dir='audio/uploads/';
    $audio_path=$dir.basename($_FILES['audioFile']['name']);
    if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$audio_path)){
        echo 'uploaded successfully.';
        saveAudio($audio_path);
        //displayAudios();

}
}

function saveAudio($fileName){
    
    $conn=mysqli_connect('localhost', 'root', '', 'google_login');
    $name = $_POST['audio_title'];
    $description = $_POST['description1'];
    $user_email = $_SESSION['email'];

    
 $query="insert into data(`type`, `name`, `description`, `user_email`) values('$fileName', '$name', '$description', '$user_email')";
 mysqli_query($conn, $query);

if(mysqli_affected_rows($conn)>0){
    echo '<br>';
    echo "audio file path saved in database";
}
    if(!$conn){
        die('ser connected');

    } 
}

echo "  thanks for uploading now uou can go to homepage to listen to your voice.";
// function displayAudios(){
//     $conn=mysqli_connect('localhost', 'root', '', 'google_login');
//     if(!$conn){
//         die('ser connected');

//     }
//     $query="select * from data";
//     $r=mysqli_query($conn, $query);
//    while($row=mysqli_fetch_array($r)){
//        echo '<br>';
//        echo ' user '.$row['id'].' just send '.$row['name'].' here is the file:';
//        echo '<a href="play.php?name='.$row['type'].'">'.$row['type'].'</a>';
//        echo "<br>";
       
//    }
  
//    mysqli_close($conn);  
// }
echo '<br>';
echo '<a href="home.php">HOME</a>';
?>
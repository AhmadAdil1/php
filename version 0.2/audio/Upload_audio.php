<?php

function saveAudio($fileName){
    $conn=mysqli_connect('localhost', 'root', '', 'google_login');
    if(!$conn){
        die('ser connected');

    } 
}
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
	// $description = mysqli_real_escape_string($conn, $_POST['description']);

    // $name = $_POST['audio_title'];
    // $description = $_POST['description1'];

    // $sql = "INSERT INTO data (name, description, type) VALUES ( $name, $description, $fileName)";
    // mysqli_query($conn, $sql);
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param('sss', $name, $description, $fileName );
  

    // $query="insert into data(type, `name`, `description`) values('{$fileName}', '$name', '$description')";
    // mysqli_query($conn, $query);

//     if(mysqli_affected_rows($conn)>0){
//         echo '<br>';
//         echo "audio file path saved in database";
//     }

//  mysqli_close($conn);
// }

if(isset($_POST['save_audio']) && $_POST['save_audio']=="upload_Audio"){
    
    $name = $_POST['audio_title'];
    $description = $_POST['description1'];

    $dir='uploads/';
    $audio_path=$dir.basename($_FILES['audioFile']['name']);
    if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$audio_path)){
        echo 'uploaded successfully.';
        saveAudio($audio_path);
        displayAudios();

}

$conn=mysqli_connect('localhost', 'root', '', 'google_login');
if(!$conn){
    die('ser connected');

} 

$query="insert into data(`type`, `name`, `description`) values('$audio_path', '$name', '$description')";
mysqli_query($conn, $query);

if(mysqli_affected_rows($conn)>0){
    echo '<br>';
    echo "audio file path saved in database";
}
}
function displayAudios(){
    $conn=mysqli_connect('localhost', 'root', '', 'google_login');
    if(!$conn){
        die('ser connected');

    }
    $query="select * from data";
    $r=mysqli_query($conn, $query);
   while($row=mysqli_fetch_array($r)){
       echo '<br>';
       echo ' user '.$row['id'].' just send '.$row['name'].' here is the file:';
       echo '<a href="play.php?name='.$row['type'].'">'.$row['type'].'</a>';
       echo "<br>";
       
   }
  
   mysqli_close($conn);  
}


?>
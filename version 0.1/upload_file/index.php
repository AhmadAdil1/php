<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>upload file</title>
    </head>
    <body>
        <?php
        $dbh = new PDO("mysql:host=localhost;dbname=google_login", "root", "");
        if(isset($_POST['btn'])){
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
        $stmt = $dbh -> prepare("insert into data values('',?,?,?)");
        $stmt->bindParam(1,$name);
        $stmt->bindParam(2,$type);
        $stmt->bindParam(3,$data);
        $stmt->execute();
    
        }
        ?>

    <form method="post" enctype="multipart/form-data">
  Select your code to upload:
  <input type="file" name="myfile" id="myfile"/>
 <button name="btn">Upload file</button>
</form>
   <?php
   $stat = $dbh -> prepare("SELECT * from data");
   $stat->execute();
   while ($row = $stat->fetch()){
       echo "<li><a target='_blank' href='upload_file/view.php?id=".$row['id']."'>".$row['name']."</a></li>";
   }
   ?>
   
<?php

// php code to Update data from mysql database Table

if(isset($_POST['update']))
{
    
   $hostname = "localhost";
   $username = "root";
   $password = "";
   $databaseName = "google_login";
   
   $connect = mysqli_connect($hostname, $username, $password, $databaseName);
   
   // get values form input text and number
   
   $id = $_POST['id'];
   $status = $_POST['status'];
  
           
   // mysql query to Update data
   $query = "UPDATE `homework` SET `status`='".$status."' WHERE `id` = $id";
   
   $result = mysqli_query($connect, $query);
   
   if($result)
   {
       echo 'Data Updated';
   }else{
       echo 'Data Not Updated';
   }
   mysqli_close($connect);
}

?>


    <body>

        <form action="index.php" method="post">

            ID To Update: <input type="text" name="id" required><br><br>

            New First Name:<input type="text" name="status" required><br><br>


            <input type="submit" name="update" value="Update Data">

        </form>

        <div class="form-group" action="index.php" method="post">
        <input type="text" name="id" value="1" required>
                                    <select  class="form-control">
                                        <option value="" selected disabled>-Select- </option>
                                        <option type="text" name="status" value="cod">Cash On Delivery</option>
                                        <option type="text" name="status" value="netbanking">Net Banking</option>

                                    </select>

                                    <input type="submit" name="update" value="Update Data">
        </div>

    </body>


</html>

    </body>
</html>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <div>
        <h1>Audio</h1>
        <form action="Upload_audio.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="audioFile"/></input>
        <br>
        <input type="text" name="audio_title" placeholder="Title"></input>
        <br>
        <textarea placeholder="Describe yourself here..." type="text" name="description1" rows="4" cols="50"></textarea>
        
        <input type="submit" value="upload_Audio" name="save_audio"/>
        </form>
        <div>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
      <audio controls>
          <source src="<?php echo $_GET['name']; ?>" type="audio/mpeg">
        </source>
      </audio>

  <?php

    include "comment_display.php";
    ?>

    </body>
</html>
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
    </head>
    <body>
        <?php
        $_SESSION["user"] = null;
        header("location: kadai_itiran.php");
        ?>
    </body>
</html>
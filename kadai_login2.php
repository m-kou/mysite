<?php
session_start();

echo $_SESSION["user"]."<br>";
require_once('./dbConfig.php');
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if($link == null){
    die("接続失敗:" . mysqli_connect_error());
}
mysqli_set_charset($link,"utf8");

$sql = "SELECT * FROM users";
$result = mysqli_query($link,$sql);

$user = $_POST['user'];
$pass = $_POST['pass'];
echo $user."<br>";
echo $pass."<br>";

$log=0;
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>レシピサイト</title>
        <link rel="stylesheet" href="stylesheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div name = "kadai_itiran" class = "itiran">
            <h1>料理一覧</h1>
            <div class = "data">
            <?php
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                //echo $row["user"]."<br>";
                //echo $row["pass"]."<br>";
                if($row["user"] == $user){
                    if($row["pass"] == $pass){
                        echo "認証成功";
                        $_SESSION["user"] = $row["user"];
                        $log++;
                    }
                }
            }
            echo "認証失敗";
            if($log==0){ 
                header("location: kadai_login.php?log=$log");
            }else{
                header("location: kadai_itiran.php");
            }
                ?>
            </div>
        </div>

        <?php
        mysqli_free_result($result);
        mysqli_close($link);
        ?>
    </body>
</html>
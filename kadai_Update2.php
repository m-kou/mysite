<?php
session_start();
require_once('./dbConfig.php');
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if($link == null){
    die("接続失敗:" . mysqli_connect_error());
}
mysqli_set_charset($link,"utf8");

$id = $_GET["id"];
$user = $_SESSION["user"];
$name = $_POST["name"];
$data = $_POST["data"];
echo $id."<br>";
echo $user."<br>";
echo $name."<br>";
echo $data."<br>";
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
        <?php
        $sql = "UPDATE `menu` SET `user`=? WHERE `id`=?";
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"si",$user,$id);   
        }
        mysqli_stmt_execute($stmt);
        
        $sql = "UPDATE `menu` SET `name`=? WHERE `id`=?";
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"si",$name,$id);   
        }
        mysqli_stmt_execute($stmt);
        
        $sql = "UPDATE `menu` SET `data`=? WHERE `id`=?";
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"si",$data,$id);   
        }
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);

        header("location: kadai_Update_edit.php");

        ?>

    </body>
</html>
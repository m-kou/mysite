<?php
session_start();
require_once('./dbConfig.php');
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if($link == null){
    die("接続失敗:" . mysqli_connect_error());
}
mysqli_set_charset($link,"utf8");

$sql = "SELECT * FROM menu";
$result = mysqli_query($link,$sql);

$id = $_GET['id'];
$user = $_SESSION["user"];
//echo $id;
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>レシピサイト</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body>
        <div class = "header">
            <div class ="header-title"><li>料理研究</li></div>  
            <div class = "header1-list">
                <ul>
                    <li><a href="kadai_itiran.php">料理一覧</a></li>
                    <li><a href="kadai_add.php">追加</a></li>
                    <li><a href="kadai_edit.php">変更・除去</a></li>
                </ul>
            </div>
            <div class = "header2-list">
                <ul>
                    <li><a href="kadai_useradd.php">新規登録</a></li>
                    <li><a href="kadai_login.php">ログイン</a></li>
                </ul>
            </div>
        </div>

        <div name = "kadai_itiran" class = "itiran">
            <h1>料理内容変更</h1>
            
            <?php
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    if($id == $row["id"]){
                        echo "<form method='post' action='kadai_Update2.php?id=". $id . "'>";
                        echo "<div>";
                        echo "<p>制作者 : ". $user ."</p>";
                        echo "<p>料理名 : "."<input name=name placeholder=" . $row["name"] ."></p>";
                        echo "<p>材　料 : "."<input name=data placeholder=" . $row["data"] ."></p>";
                        echo "</div>";
                        echo "<p><input type='submit' value='変更'></p>";
                        
                    }
                }
            ?>
            </form>
        </div>

        <?php
        mysqli_free_result($result);
        mysqli_close($link);
        ?>

    </body>
</html>

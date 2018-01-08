<?php
require_once('./dbConfig.php');
$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if($link == null){
    die("接続失敗:" . mysqli_connect_error());
}
mysqli_set_charset($link,"utf8");

$sql = "SELECT * FROM menu";
$result = mysqli_query($link,$sql);
$log = "null";
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>レシピサイト</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
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
                    <?php
                    if (isset($_SESSION["user"])){
                        echo "<li><a href='kadai_logout.php'>ログアウト</a></li>";
                    }else{
                        echo "<li><a href='kadai_login.php'>ログイン</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>


        <?php
        echo "<div class='us'>";
        if (isset($_SESSION["user"])){
            echo "USER : " . $_SESSION["user"];
        }else{
            echo "USER : GUEST";
        }
        echo "</div>";
        ?>

        <?php
            if($log=="0")   echo "ログイン失敗";
        ?>
                
        <div class = "add">
            <h1>ログイン</h1>
            <form action="kadai_login2.php" method="post">
                <p>USER:<input type="text" name="user"></p>
                <p>PASS:<input type="text" name="pass"></p>
                <p><input type="submit" value="ログイン"></p>
            </form>
        </div>

        <?php
        mysqli_free_result($result);
        mysqli_close($link);
        ?>
    </body>
</html>
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
$user = $_SESSION["user"];
?>

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

        <div name = "kadai_itiran" class = "itiran">
            <h1>料理一覧</h1>
            <div class = "data">
                <?php
                $count = 1;
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    echo "<div class='menu'>";
                    //echo "<p>id    " . $row["id"] . "</p>";
                    echo "<p>制作者 " . $row["user"] . "</p>";
                    echo "<p>料理名 " . $row["name"] . "</p>";
                    echo "<p>材　料 " . $row["data"] . "</p>";
                    
                    if($row["user"] == $user) {
                        echo "<a href = kadai_Update.php?id=" . $row["id"] . ">変更</a>";
                        echo "<a href = kadai_edit.php?id=" . $row["id"] . ">除去</a>";
                    }
                    echo "</div>";
                    $count++;
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
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

$user = $_SESSION['user'];
$id = $_GET['id'];
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
            echo "USER : $user";
        }else{
            $user = "GUEST";
            echo "USER : $user";
        }
        echo "</div>";
        ?>
       
        <div class = "add">
            <h1>コメント</h1>
            <form action="kadai_commentadd2.php?id=<?php echo $id ?>&user=<?php echo $user ?>" method="post">
                <p>USER : <?php echo $user?></p>
                <p>コメントの内容 : <input type="text" name="comment"></p>
                <p><input type="submit" value="登録する"></p>
            </form>
        </div>

        <?php
        mysqli_free_result($result);
        mysqli_close($link);
        ?>



    </body>
</html>
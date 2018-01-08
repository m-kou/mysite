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

$sql2 = "SELECT * FROM comments";
$result2 = mysqli_query($link,$sql2);

$cnt = 0;
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>レシピサイト</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="pro.css" />
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
       
        <div class="image"> 
            <img src="sozai1.jpg" name="sushi">

            <script type="text/javascript">
                img = new Array("sozai1.jpg","sozai2.jpg","sozai3.jpg","sozai4.jpg"); //*1
                count = -1; //*2
                imgTimer();

                function imgTimer() {
                    //画像番号
                    count++; //*3
                    //画像の枚数確認
                    if (count == img.length) count = 0; //*4
                    //画像出力
                    document.sushi.src = img[count]; //*5
                    //次のタイマー呼びだし
                    setTimeout("imgTimer()",3000); //*6
                }
            </script>
        </div>

        <div name = "kadai_itiran" class = "itiran">
            <h1>料理一覧</h1>
            <div class = "data">
                <?php
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    echo "<div class='menu'>";
                        //echo "<p>id    " . $row["id"] . "</p>";
                        echo "<p>制作者 " . $row["user"] . "</p>";
                        echo "<p>料理名 " . $row["name"] . "</p>";
                        echo "<p>材　料 " . $row["data"] . "</p>";
                        //コメント表示

                        echo "<div class='com'>";
                        echo "<li class='content-list-item'>";
                        echo "<p>コメント</p>";
                        echo "<span>+</span>";
                        echo "<div class='answer'>";
                    
                        $result2 = mysqli_query($link,$sql2);
                    
                        $cnt = 0;
                        
                        while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                            if($row2["menuID"] == $row["id"]){
                                echo "<p>" . $row2["user"] . ":" . $row2["comment"] . "</p>";
                                $cnt++;
                            }
                        }
                        if(!($cnt))   echo "コメントはありません。";
                        echo "<a id = 'commentadd' href = kadai_commentadd.php?id=" . $row["id"] . ">コメントする</a>";
                        mysqli_free_result($result2);
                    echo "</div>";

                    echo "</li>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        

        <?php
        mysqli_free_result($result);
        mysqli_close($link);
        ?>
        <script src="script.js"></script>
    </body>
</html>
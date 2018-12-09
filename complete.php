<?php
ini_set('display_errors', 'stderr');
error_reporting(E_ALL);

define('DB_DATABASE', 'nishimaki_db');
define('DB_USERNAME', 'nishimaki');
define('DB_PASSWORD', 'M4h56Rcr');
define('PDO_DSN', 'mysql:host=localhost;dbname=' . DB_DATABASE);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>完了画面</title>
</head>
<body>
    <p>登録完了しました！</p>
    <?php
    session_start();

    echo "<b>〇登録内容</b><br>";
    echo "学籍番号 ： ".htmlspecialchars($_SESSION['id'], ENT_QUOTES)."<br>";
    echo "名前 : ".htmlspecialchars($_SESSION['name'], ENT_QUOTES)."<br>";
    echo "年齢 ： ".htmlspecialchars($_SESSION['age'], ENT_QUOTES)."<br>";
    echo "備考 ： ".htmlspecialchars($_SESSION['note'], ENT_QUOTES)."<br>";
    echo "<br>ご登録ありがとうございました．<br><br>";
    echo "<a href=\"./index.php\">Topへ</a>";

    try{
        // connect
        $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("insert into users (id, name, age, time) values (?, ?, ?, ?)");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $name, PDO::PARAM_STR);
        $stmt->bindParam(3, $age, PDO::PARAM_INT);
        $stmt->bindParam(4, $time, PDO::PARAM_STR);

        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
        $age = $_SESSION['age'];
        $time = date("Y-m-d H:i:s");
        $stmt->execute();

        // 切断
        $db = null;
    } catch(PDOException $e){
        echo "データベース接続失敗" . PHP_EOL;
        echo $e->getMessage();
        exit;
    }
    session_destroy();
    ?>
</body>
</html>

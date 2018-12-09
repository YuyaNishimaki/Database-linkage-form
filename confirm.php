<?php
ini_set('display_errors', 'stderr');
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>確認画面</title>
</head>
<body>
    <?php
    session_start();
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['note'] = $_POST['note'];

    $bConfirm = array('id'=>TRUE, 'name'=>TRUE, 'age'=>TRUE);
	$nextPage = TRUE;

    if (empty($_SESSION['id'])) $bConfirm['id'] = FALSE;
    if ($_SESSION['age'] === '未選択') $bConfirm['age'] = FALSE;

    foreach($bConfirm as $value){
		if(!$value){
			$nextPage = FALSE;
		}
	}

    if($nextPage){
		echo "以下の内容でよろしいでしょうか?<br><br>";
		echo "学籍番号 ： " . htmlspecialchars($_SESSION['id'], ENT_QUOTES) . "<br>";
		echo "名前 : " . htmlspecialchars($_SESSION['name'], ENT_QUOTES) . "<br>";
		echo "年齢 ： " . htmlspecialchars($_SESSION['age'], ENT_QUOTES) . "<br>";
        echo "備考 ： " . nl2br(htmlspecialchars($_SESSION['note'], ENT_QUOTES)) . "<br>";
		echo "<br><b><a href=\"complete.php\">確認した上で登録<a></b>";
	} else{
		echo "<br><font color=\"red\">入力の足りない箇所があります。</font><br><br>";

		echo "学籍番号 : ";
		if(!$bConfirm['id']) {
            echo "<font color=\"red\">学籍番号の入力がありません</font><br>";
        } else {
			echo htmlspecialchars($_SESSION['id'], ENT_QUOTES)."<br>";
		}

		echo "名前: " . htmlspecialchars($_SESSION['name'], ENT_QUOTES) ."<br>";

		echo "年齢 : ";
		if(!$bConfirm['age']) echo "<font color=\"red\">年齢の入力がありません</font><br>";
		else {
			echo htmlspecialchars($_SESSION['age'], ENT_QUOTES)."<br>";
		}

        echo "備考 ： ". nl2br(htmlspecialchars($_SESSION['note'], ENT_QUOTES)) . "<br>";

		echo "<br><a href=\"input.php\">戻る</a>";
	}
    ?>
</body>
</html>

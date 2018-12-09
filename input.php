<?php
ini_set('display_errors', 'stderr');
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>入力フォーム</title>
</head>
<body>
    <form action="confirm.php" method="post">
        <?php
        session_start();
        $id = '';
        $name ='';
        $age = '';
        $note = '';

        if(isset($_SESSION['id'])) $id = $_SESSION['id'];
        if(isset($_SESSION['name'])) $name = $_SESSION['name'];
        if(isset($_SESSION['age'])) $age = $_SESSION['age'];
        if(isset($_SESSION['note'])) $note = $_SESSION['note'];
        ?>

        <p>学籍番号: <input type="number" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>"></p>
        <p>名前: <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" required></p>
        <p>年齢:
            <select name="age">
                <option value="未選択">選択してください</option>
                    <?php for ($i = 0; $i <= 100; $i++) {
                            if ($i == $age) {
                                echo "<option value='{$i}' selected>{$i}</option>";
                            } else {
                                echo "<option value='{$i}'>{$i}</option>";
                            }
                    } ?>
            </select>
        </p>
        <p>備考: <textarea name="note"><?php echo htmlspecialchars($note, ENT_QUOTES, 'UTF-8'); ?></textarea></p>
        <p><input type="submit" name="" value="送信"></p>
    </form>
</body>
</html>

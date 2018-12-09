<?php
ini_set('display_errors', 'stderr');
error_reporting(E_ALL);

define('DB_DATABASE', 'nishimaki_db');
define('DB_USERNAME', 'nishimaki');
define('DB_PASSWORD', 'M4h56Rcr');
define('PDO_DSN', 'mysql:host=localhost;dbname=' . DB_DATABASE);

class User {
    public function show() {
        echo "<p>$this->id $this->name $this->age</p>";
    }
}

try {
    // connect
    $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // select all
    $stmt = $db->query("select * from users order by time desc");
    $users = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    foreach ($users as $user) {
        $user->show();
    }

    // disconnect
    $db = null;

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

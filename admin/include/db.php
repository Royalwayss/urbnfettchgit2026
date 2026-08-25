<?php
date_default_timezone_set("Asia/Calcutta");

$settingFile = __DIR__ . '/setting.php';

if (file_exists($settingFile)) {
    require_once($settingFile);

    $conn = new mysqli($_host, $_username, $_password, $_database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    define('BASEURL', $baseurl);
}
?>
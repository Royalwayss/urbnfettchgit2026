<?php
date_default_timezone_set("Asia/Calcutta");
require_once('setting.php');
$conn = new mysqli($_host, $_username, $_password,$_database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}	
define('BASEURL',$baseurl);
?>
<?php session_start();
date_default_timezone_set('America/Chicago');
    
$server = 'localhost';
$u = 'root';
$p = 'usbw';
$db = 'loginassignment';

$conn = new mysqli($server, $u, $p, $db);
if($conn->connect_error)
{
    die('Connection Failed:' . $conn->connect_error);
}

$userid = $_GET['userid'];
$followid = $_GET['followid'];

echo $userid . " " . $followid;

if($userid == $followid)
{
    header("Location: ../Base/home.php");
    die();
}

$stmt = $conn->prepare("delete from followers where user_id = ? and follow_id = ?");
$stmt->bind_param('ii', $userid, $followid);
$stmt->execute();

header("Location: ../Base/home.php");
die();

?>
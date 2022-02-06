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
$stmt = $conn->prepare("select userid, followid from followers where userid = ? and followid = ?");
if($stmt)
{
    
    /*
    header("Location: ../Base/home.php");
    die();
    */
}

$stmt = $conn->prepare("insert into followers(user_id, follow_id) values(?,?)");
$stmt->bind_param('ii', $userid, $followid);
$stmt->execute();

header("Location: ../Base/home.php");
die();

?>
<?php session_start();
$server = 'localhost';
$u = 'root';
$p = 'usbw';
$db = 'loginassignment';

$conn = new mysqli($server, $u, $p, $db);
if($conn->connect_error)
{
    die('Connection Failed:' . $conn->connect_error);
}
$tweet = $_POST["tweet"];
$user = $_SESSION["user"];
$userid = "";

if(!preg_match('/^[A-Za-z0-9_ -]+$/',$tweet))
{
    $_SESSION['invalidCharacters'] = true;
    header('Location: createTweet.php');
    die();
}

$author = $conn->prepare("select id from users where username = ?");
$author->bind_param('s', $user);
$author->execute();
$author->bind_result($temp);
while($author->fetch())
{
    $userid = $temp;
}

$insert = $conn->prepare("insert into tweet_data(author_id, content) values(?, ?)");
$insert->bind_param('is', $userid, $tweet);
$insert->execute();

header('Location: ../Base/home.php');
die();
?>
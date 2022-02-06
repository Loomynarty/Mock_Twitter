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
$user = $_POST["user"];
$pass = $_POST["password"];
echo $user." <br>";
echo $pass." <br>";

if(!preg_match('/^[A-Za-z0-9_]+$/',$user))
{
    $_SESSION['invalidUser'] = true;
    header('Location: login.php');
    die();
}
else if(strlen($user) >= 20 || strlen($user) < 3)
{
    $_SESSION['longUser'] = true;
    header('Location: login.php');
    die();
}

$check = $conn->prepare("select username, password from users where username = ?");
$check->bind_param('s', $user);
$check->execute();
$check->bind_result($dupe, $dupe2);

$same = false;

while($check->fetch())
{
    echo 'Name: ' . $dupe . ' <br>';
    if($dupe == $user && $dupe2 == $pass)
    {
        $same = true;
        break;
    }
}

//Account found
if($same)
{
    $_SESSION['user'] = $user;
    header('Location: home.php');
    die();
}
//No account found
else
{
    $_SESSION['loginFail'] = true;
    header('Location: login.php');
    die();
}
?>
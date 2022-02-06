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
    header('Location: regi.php');
    die();
}
else if(strlen($user) >= 20)
{
    $_SESSION['longUser'] = true;
    header('Location: regi.php');
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
    if($dupe == $user)
    {
        $same = true;
        break;
    }
}

//same is false
if(!$same)
{
    echo "a <br>";
    $stmt = $conn->prepare("insert into users(username, password) values (?,?)");
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();

    $_SESSION['success'] = true;
    header('Location: login.php');
    die();
}
//same is true
else
{
    $_SESSION['regiDupe'] = true;
    header('Location: regi.php');
    die();
}
?>
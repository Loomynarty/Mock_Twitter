<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
</head>
<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">
            </h1>
            <button class="btn btn-primary" onclick="location.href = '../Base/home.php'">Go Back</button>
        </div>
    </div>
    <?php
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

    $text = $conn->prepare("select username from users where username = ?");
    $text->bind_param('s', $_POST['search']);
    $text->execute();
    $text->bind_result($user);

    echo "<div style='max-width:100%' class='container'>
    <div class='row'>";

    while($text->fetch())
    {
        echo "<div class='card pr-3 mx-1'>
                <div class='card-body'>
                <h5><a href='../Tweets/user.php?name=".$user."'>".$user."</a></h5>
                </div>
            </div>";
    }

    echo "</div>
    </div>";        
            
    ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>

</html>
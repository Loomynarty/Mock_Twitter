<!doctype html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
</head>
<?php

if(!preg_match('/^[0-9]+$/', $_GET['id']))
{
    header('Location: home.php');
    die();
}

?>
<body>
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

        $name = "";

        $author = $conn->prepare("select username from users join tweet_data on (author_id = id) where tweet_id = ?");
        $author->bind_param('i', $_GET['id']);
        $author->execute();
        $author->bind_result($temp);
        while($author->fetch())
        {
            $name = $temp;
        }

        $text = $conn->prepare("select content, time from tweet_data where tweet_id = ?");
        $text->bind_param('i', $_GET['id']);
        $text->execute();
        $text->bind_result($content, $time);
        
        echo "<div style='max-width:100%' class='container'>
        <div class='row'>";
        while($text->fetch())
        {
                echo "<div class='card pr-3 mx-1'>
                        <div class='card-body'>
                        <h5> <a href='user.php?name=".$name."'>" . $name . "</a></h5>
                        <h6 class='card-subtitle mb-2 text-muted'>" . date('D, M j g:i:s A', strtotime($time)) . "</h6>
                            <div style='padding:0px' class='col'>
                            <p>" . $content . "</p>
                            </div> 
                        </div>
                      </div>";
        }
        echo "</div>
        </div>";

        if($text->num_rows == 0)
        {
            echo "<div class='card pr-3 mx-1'>
                        <div class='card-body'>
                            <div style='padding:0px' class='col'>
                            <p style='text-align: center'> Undefined</p>
                            </div> 
                        </div>
                    </div>";
        }

?>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>

</html>
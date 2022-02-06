<!doctype html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">
                <?php session_start();
        if(!isset($_SESSION['user']))
        {
            header('Location: landing.php');
            die();
        }
        else
        {
            echo "Welcome " . $_SESSION['user'];
        }
        ?>
            </h1>
            <button class="btn btn-primary" onclick="location.href = '../Tweets/createTweet.php'">Tweet</button>
            <button class="btn btn-primary" onclick="location.href = '../Follow/following.php'">
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

                $follow = $conn->prepare("select count(username) from users where id in (select follow_id from followers join users on (users.id = user_id) where username = ?)");
                $follow->bind_param('s', $_SESSION['user']);
                $follow->execute();
                $follow->bind_result($result);
                while($follow->fetch())echo $result." ";
                ?>Following</button>
            <button class="btn btn-primary" onclick="location.href = '../Follow/followers.php'">                
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

                $follow = $conn->prepare("select count(username) from users where id in (select user_id from followers join users on (users.id = user_id) where follow_id = (select id from users where username = ?))");
                $follow->bind_param('s', $_SESSION['user']);
                $follow->execute();
                $follow->bind_result($result);
                while($follow->fetch())echo $result." ";
                ?>Followers</button>
            <button class="btn btn-primary" onclick="location.href = '../Tweets/search.php'">Search</button>
            <button class="btn btn-primary" onclick="location.href = 'logout.php'">Logout</button>
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

        $userid = "";

        $author = $conn->prepare("select id from users where username = ?");
        $author->bind_param('s', $_SESSION['user']);
        $author->execute();
        $author->bind_result($temp);
        while($author->fetch())
        {
            $userid = $temp;
        }

        
        $text = $conn->prepare("select username, content, time from tweet_data join users on (users.id = author_id) where author_id in (select id from users where id in (select follow_id from followers join users on (users.id = user_id) where username = ?)) order by time desc");
        $text->bind_param('s', $_SESSION['user']);
        $text->execute();
        $text->bind_result($user, $content, $time);
        
        echo "<div style='max-width:100%' class='container'>
        <div class='row'>";

        while($text->fetch())
        {
            echo "<div class='card pr-3 mx-1'>
                    <div class='card-body'>
                    <h5><a href='../Tweets/user.php?name=".$user."'>" . $user . "</a></h5>
                    <h6 class='card-subtitle mb-2 text-muted'>" . date('D, M j g:i:s A', strtotime($time)) . "</h6>
                        <div style='padding:0px' class='col'>
                        <p>" . $content . "</p>
                        </div> 
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
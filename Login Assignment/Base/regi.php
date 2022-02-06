<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
</head>

<body>
    <div class="card m-5">
        <div class="card-body">
            <form method="post" action="regiHandler.php">
                <p>Register</p>
                <div class="form-group">
                    <label for="user">Username</label>
                    <input name="user" class="form-control" id="user" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" class="form-control" id="password" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-primary" onclick="location.href = 'landing.php'">Go Back</button>
            </form>
            <?php session_start();
            if(isset($_SESSION['regiDupe']))
            {
                echo 'That username has already been taken!';
                unset($_SESSION['regiDupe']);
            }
            if(isset($_SESSION['invalidUser']))
            {
                echo 'Only alphanumeric characters and underscore are allowed!';
                unset($_SESSION['invalidUser']);
            }
            if(isset($_SESSION['longUser']))
            {
                echo 'Only usernames between 3 and 20 characters long please!';
                unset($_SESSION['longUser']);
            }
            ?>
        </div>
    </div>



</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>

</html>
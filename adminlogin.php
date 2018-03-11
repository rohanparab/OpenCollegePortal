<?php
    session_start();
    include 'credentials.php';
    include 'config.php';
    $conn = mysqli_connect($server, $user, $pass, $db);     #database connection variable
?>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- bootstrap include -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Done -->

        <link rel="stylesheet" href="styles/adminlogin.css">
    </head>
    <body>
        <div class="cellcenterparent">
            <div class="cellcentercontent">
                <center>
                    <div class="loginbox">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                            <h1>Admin Login</h1>
                            <p>Enter user ID : </p>
                            <input type="text" name="userid" class="form-control" required>
                            <p>Enter Password : </p>
                            <input type="password" name="pass" class="form-control" required>
                            <br>
                            <button type="submit" class="btn btn-success form-control" name="login">Login</button>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['login'])){
            $uid = mysqli_real_escape_string($conn, $_POST['userid']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            $sqllogin = "SELECT * FROM login WHERE uid = '$uid' AND pass = '$pass' AND adminlogin = 'true'";
            $result = mysqli_query($conn, $sqllogin);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['auid'] = $uid;
                $_SESSION['apass'] = $pass;

                $ip = $_SERVER["REMOTE_ADDR"];
                date_default_timezone_set('Asia/Kolkata');
                $datet = date('d-m-Y H:i:s');

                $sqlog = "INSERT INTO iplog(ip, datet) VALUES('$ip', '$datet')";

                mysqli_query($conn, $sqlog);
                echo "<script>document.location='adminpanel.php';</script>";
            }
        }
    }
?>
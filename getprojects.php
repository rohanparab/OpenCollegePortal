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
    <link rel="stylesheet" href="styles/getprojects.css">
</head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><?php echo $collegebrand; ?></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">HOME</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="main container">
            <?php
            $sqlgetproject = "SELECT * FROM projects";
            $projectres = mysqli_query($conn, $sqlgetproject);
            if (mysqli_num_rows($projectres) > 0) {
                while ($row = mysqli_fetch_assoc($projectres)) {
            ?>
                    <div class="card">
                        <h3><b><?php echo $row['name']; ?></b></h3>
                        <p><?php echo $row['content']; ?></p>
                        <p><b>URL : </b><?php echo $row['url']; ?></p>
                        <p><b>Phone : </b><?php echo $row['phone']; ?></p>
                    </div>
            <?php
                }
            }else{
                echo "0 results";
            }
            ?>
        </div>
    </body>
</html>
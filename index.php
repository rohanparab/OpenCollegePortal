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
        <link rel="stylesheet" href="styles/index.css">
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
                    <a class="navbar-brand" href="#"><?php echo $collegebrand; ?></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li><a href="logout.php">LOGOUT</a></li>-->
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main">
            <h2>Open College Portal</h2>
        </div>
        <center>
            <div class="browse">
                <form action="getfiles.php" method="post">
                    <p>Select Department : </p>
                    <select class="form-control" name="dept">
                        <?php
                        $sqlseldept = "SELECT * FROM departments";
                        $seldeptres = mysqli_query($conn, $sqlseldept);
                        if (mysqli_num_rows($seldeptres) > 0) {
                            while($row = mysqli_fetch_assoc($seldeptres)){
                                $dname = $row['dname'];
                                echo "<option value='$dname'>$dname</option>";
                            }
                        }
                        ?>
                    </select>

                    <p>Select Semester : </p>
                    <select class="form-control" name="sem">
                        <option value="sem1">SEM 1</option>
                        <option value="sem2">SEM 2</option>
                        <option value="sem3">SEM 3</option>
                        <option value="sem4">SEM 4</option>
                        <option value="sem5">SEM 5</option>
                        <option value="sem6">SEM 6</option>
                        <option value="sem7">SEM 7</option>
                        <option value="sem8">SEM 8</option>
                    </select>

                    <br>

                    <button type="submit" class="btn btn-success form-control" name="getfile">GO</button>
                </form>
                <br>
                <a href="getprojects.php"><button type="submit" class="btn btn-red form-control">Check Projects</button></a>
            </div>
        </center>
    </body>
</html>
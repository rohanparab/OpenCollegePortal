<?php
    session_start();
    include 'credentials.php';
    include 'config.php';
    $conn = mysqli_connect($server, $user, $pass, $db);     #database connection variable
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['getfile'])){
            if(isset($_POST['dept']) and isset($_POST['sem'])){
                $dept = mysqli_real_escape_string($conn, $_POST['dept']);
                $sem = mysqli_real_escape_string($conn, $_POST['sem']);
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
        <link rel="stylesheet" href="styles/getfiles.css">
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
                        <li><a href="index.php">HOME</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="main">
<?php
                    $sqlgetfiles = "SELECT * FROM files WHERE department = '$dept' AND sem = '$sem'";
                    $fileres = mysqli_query($conn, $sqlgetfiles);
                    if (mysqli_num_rows($fileres) > 0) {
                        echo '<table class="table table-responsive">';
                        echo '<tr><th>File Name</th><th>Download</th><th>Date</th></tr>';
                        while($row = mysqli_fetch_assoc($fileres)){
                            $fid = $row['id'];
                            ?>
                            <tr>
                                <td><?php echo $row['filename']; ?></td>
                                <td><a href="uploads/<?php echo $row['filemd']; ?>" download="<?php echo $row['filename']; ?>"><button class="btn btn-success">Download</button></a></td>
                                <td><?php echo $row["datet"]; ?></td>
                            </tr>
                            <?php
                        }
                        echo '</table>';
                    }else{
                        echo "0 Files";
                    }
?>
            <br>
            <a href="index.php">Go Back</a>
        </div>
    </body>
</html>
<?php
            }
        }
    }
?>
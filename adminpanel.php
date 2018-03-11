<?php
    session_start();
    include 'credentials.php';
    include 'config.php';
    $conn = mysqli_connect($server, $user, $pass, $db);     #database connection variable
    if(isset($_SESSION['auid']) and isset($_SESSION['apass'])){
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
        <link rel="stylesheet" href="styles/adminpanel.css">
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
                    <a class="navbar-brand" href="#myPage">Admin Panel</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <br>
        <br>
        <ul class="nav nav-pills nav-stacked col-md-2 nav-filter">
            <li class="active inactive"><a href="#dept" data-toggle="pill">Manage Department</a></li>
            <li class="inactive"><a href="#files" data-toggle="pill">Manage Files</a></li>
            <li class="inactive"><a href="#projects" data-toggle="pill">Manage Projects</a></li>
            <li class="inactive"><a href="#changepass" data-toggle="pill">Change Password</a></li>
        </ul>
        <div class="tab-content col-md-10" style="background-color: #d6d6c2;">
            <div class="tab-pane fade in active" id="dept">
                <div class="card">
                    <h2>Add Department</h2>
                    <br><br>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                        <p>Enter Department name : </p>
                        <input type="text" class="form-control" name="deptname">
                        <br><br>
                        <button type="submit" class="btn btn-success form-control" name="adddept">Add</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade in" id="changepass">
                <div class="card">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                        <h2>Change admin password</h2>
                        <p>Enter new password : </p>
                        <input type="password" class="form-control" name="newpass">
                        <p>Enter new password again : </p>
                        <input type="password"class="form-control" name="cnewpass">
                        <button type="submit" class="btn btn-danger form-control" name="changepass">Change password</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade in" id="files">
                <div class="card">
                    <h2>Upload File</h2>
                    <br>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <br>
                        <p>Select Department : </p>
                        <select class="form-control" name="uploadept">
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

                        <br>
                        <p>Select Semester : </p>
                        <select class="form-control" name="uploadsem">
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
                        <button type="submit" name="uploadfile" class="btn btn-success form-control">Upload</button>
                    </form>
                    <br>
                    <br>
                    <h2>Your uploaded files : </h2>
                    <?php
                    $sqlgetuserfiles = "SELECT * FROM files";
                    $ufileres = mysqli_query($conn, $sqlgetuserfiles);
                    if (mysqli_num_rows($ufileres) > 0) {
                        echo '<table class="table table-responsive">';
                        echo '<tr><th>File Name</th><th>Download</th><th>Delete</th><th>Department</th><th>Sem</th></tr>';
                        while($row = mysqli_fetch_assoc($ufileres)){
                            $fid = $row['id'];
                    ?>
                            <tr>
                                <td><?php echo $row['filename']; ?></td>
                                <td><a href="uploads/<?php echo $row['filemd']; ?>" download="<?php echo $row['filename']; ?>"><button class="btn btn-success">Download</button></a></td>
                                <td><a href="delete.php?id=<?php echo $row['id']; ?>&filen=<?php echo $row['filemd']; ?>"><button class="btn btn-danger">Delete</button></a></td>
                                <td><?php echo $row["department"]; ?></td>
                                <td><?php echo $row["sem"]; ?></td>
                            </tr>
                    <?php
                        }
                        echo '</table>';
                    }else{
                        echo "0 Files";
                    }
                    ?>
                </div>
            </div>

            <div class="tab-pane fade in" id="projects">
                <div class="card">
                    <h2>Add Project</h2>
                    <br><br>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                        <p>Enter Project topic : </p>
                        <input type="text" name="projectname" class="form-control" required>
                        <p>Enter A short description : </p>
                        <textarea class="form-control" name="projectcontent" required></textarea>
                        <p>Enter Project link (Github or any URL Optional) : </p>
                        <input type="text" name="projecturl" class="form-control">
                        <p>Enter Phone Number : </p>
                        <input type="number" class="form-control" name="phonenumber" required>
                        <br>
                        <button class="btn btn-success form-control" name="addproject">Add Project</button>
                    </form>
                    <br>
                    <h2>Delete Project</h2>
                    <br>
                    <?php
                        $sqlgetproject = "SELECT * FROM projects";
                        $projectres = mysqli_query($conn, $sqlgetproject);
                        if (mysqli_num_rows($projectres) > 0) {
                            echo '<table class="table table-responsive">';
                            echo '<tr><th>Project Name</th><th>Delete</th></tr>';
                            while ($row = mysqli_fetch_assoc($projectres)) {
                                $fid = $row['id'];
                        ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><a href="deleteproject.php?id=<?php echo $row['id'] ?>"><button class="btn btn-danger">Delete</button></a></td>
                            </tr>
                        <?php
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </body>
</html>
<?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["adddept"])){
                $dept = mysqli_real_escape_string($conn, $_POST['deptname']);
                $sqladdept = "INSERT INTO departments(dname) VALUES('$dept')";
                if(mysqli_query($conn, $sqladdept)){
                    echo "<script>alert('Department Added'); document.location='adminpanel.php';</script>";
                }else{
                    echo "<script>alert('Error Occured'); document.location='adminpanel.php';</script>";
                }
            }

            if(isset($_POST['uploadfile'])){
                $uploadept = mysqli_real_escape_string($conn, $_POST["uploadept"]);
                $uploadsem = mysqli_real_escape_string($conn, $_POST["uploadsem"]);
                date_default_timezone_set("Asia/Calcutta");
                $datet = date("d-m-Y-h-i-s");
                $target_dir = "uploads/";
                $target_file = $target_dir . md5($datet . basename($_FILES["fileToUpload"]["name"]));
                $filebasename = basename($_FILES["fileToUpload"]["name"]);
                $filemd5 = md5($datet . basename($_FILES["fileToUpload"]["name"]));
                $uploadOk = 1;

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "File was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        $sqlinsertfile = "INSERT INTO files(filename, filemd, datet, department, sem) VALUES('$filebasename', '$filemd5','$datet','$uploadept','$uploadsem')";
                        if(mysqli_query($conn, $sqlinsertfile)){
                            echo "<script>alert('File Uploaded'); document.location='adminpanel.php';</script>";
                        }else{
                            echo "<script>alert('Error Has occured'); document.location='adminpanel.php';</script>";
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }

            if(isset($_POST["addproject"])){
                $projectname = mysqli_real_escape_string($conn, $_POST['projectname']);
                $projectdescription = mysqli_real_escape_string($conn, $_POST['projectcontent']);
                $projecturl = mysqli_real_escape_string($conn, $_POST['projecturl']);
                $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);

                $sqlprojectin = "INSERT INTO projects(name,content,url,phone) VALUES('$projectname', '$projectdescription', '$projecturl', '$phonenumber') ";

                if(mysqli_query($conn, $sqlprojectin)){
                    echo "<script>alert('Project Added'); document.location='adminpanel.php';</script>";
                }else{
                    echo "<script>alert('Error has occured'); document.location='adminpanel.php';</script>";
                }
            }

            if(isset($_POST['changepass'])){
                $pass = mysqli_real_escape_string($conn, $_POST['newpass']);
                $cpass = mysqli_real_escape_string($conn, $_POST['cnewpass']);

                if($pass == $cpass){
                    $enpass = md5($pass);
                    $sqlchngpass = "UPDATE login SET pass = '$enpass' WHERE adminlogin = 'true'";
                    if(mysqli_query($conn, $sqlchngpass)){
                        echo "<script>alert('Password changed');</script>";
                    }else{
                        echo "<script>alert('error occured');</script>";
                    }
                }
            }
        }
    }
?>

<?php
    session_start();
    if(isset($_SESSION['auid']) and isset($_SESSION['apass'])){
        include 'credentials.php';
        $conn = mysqli_connect($server, $user, $pass, $db);
        $fid = mysqli_real_escape_string($conn, $_GET['id']);
        $filen = mysqli_real_escape_string($conn, $_GET['filen']);

        $sqldel = "DELETE FROM files WHERE id=$fid";
        if(mysqli_query($conn, $sqldel)){
            unlink("uploads/$filen");
            echo "<script>alert('File Deleted'); document.location='adminpanel.php';</script>";
        }else{
            echo "<script>alert('Error Occured'); document.location='adminpanel.php';</script>";
        }
    }
?>

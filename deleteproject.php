<?php
    session_start();
    if(isset($_SESSION['auid']) and isset($_SESSION['apass'])){
        include 'credentials.php';
        $conn = mysqli_connect($server, $user, $pass, $db);
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sqldel = "DELETE FROM projects WHERE id=$id";
        if(mysqli_query($conn, $sqldel)){
            echo "<script>alert('Project Deleted'); document.location='adminpanel.php';</script>";
        }else{
            echo "<script>alert('Error Occured'); document.location='adminpanel.php';</script>";
        }
    }
?>

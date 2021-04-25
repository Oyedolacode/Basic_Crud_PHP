<?php 
// Initialize the session
if(!isset($_SESSION)){
    session_start();
}

$mysqli = new mysqli('localhost','root', '' , 'basic_crud') or die(mysqli_error($mysqli));

// set var
$id = 0;
$update = false;
$username = '';
$course = '';

if (isset($_POST['save'])){
    $username = $_POST['username'];
    $course = $_POST['course'];

    $mysqli->query("INSERT INTO user (username, course) VALUES('$username', '$course')") or die($mysqli->error);

    $_SESSION['message'] = "Course has been saved";
    $_SESSION['msg_type'] = "success";

    header("location: dashboard.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM user WHERE id=$id") or die($mysqli->error);

    
    $_SESSION['message'] = "Course has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: dashboard.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM user WHERE id=$id") or die($mysqli->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $username = $row['username'];
        $course = $row['course'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $course = $_POST['course'];

    $mysqli->query("UPDATE user SET username='$username', course='$course' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "Warning";

    header('location: dashboard.php');
}
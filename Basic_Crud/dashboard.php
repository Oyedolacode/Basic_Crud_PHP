<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <title>BASIC CRUD APP</title>
 </head>
 <body>
<!---Include config file----->
<?php require_once "config.php"; ?>


<!--check msg-->
    <?php if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">

          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
       </div>
    <?php endif ?>
<?php 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli('localhost','root', '' , 'basic_crud') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM user") or die($mysqli->error);
?>

<p><a href="index.php">Home</a>
  <a href="dashboard.php">View All Courses</a>
  <a href="logout.php">Logout</a></p>
<div class="container">
    <div class= "row justify-content-center">
      <table class = "table">
        <thead>
    <tr>
        <th>username</th>
        <th>course</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <?php 
    while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['course']; ?></td>
        <td>
        <a href="dashboard.php?edit=<?php echo $row['id']; ?>"
        class="btn btn-info">Edit</a>
        <a href="dashboard.php?delete=<?Php echo $row['id']; ?>"
        class="btn btn-danger">Delete</a>
        <a href="view.php?view=<?Php echo $row['id']; ?>"
        class="btn btn-primary">View</a>
        </td>
    </tr>
    <?php endwhile; ?>
    </table>
    </div>
</div>
<?php 

function pre_r($array){
    echo '<prev>';
    print_r($array);
    echo '</pre>';
}


?>

<div class="container">
    <div class="row-justify-content-center">
    <form action="config.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <div class="form-group">
    <label>User</label>
    <input type="text" name="username" class="form-control" value="<?php echo $username ?>" placeholder="Enter your username">
    </div>
    <div class="form-group">
    <label>Course</label>
    <input type="text" name="course" class="form-control" value="<?php echo $course; ?>" placeholder="Enter your course">
    </div>
    <div class="form-group">
    <?php 
    if ($update == true):
    ?>
    <button type="submit" class="btn btn-primary" name="update">Update</button>
    <?php else: ?>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif ?>
    </div>
    </form>
    </div>
</div>
</body>
</html>
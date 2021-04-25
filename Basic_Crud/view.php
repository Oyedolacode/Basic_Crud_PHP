<?php

include "config.php";

/* Attempt to connect to MySQL database */
$mysqli = new mysqli('localhost','root', '' , 'basic_crud') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM user") or die($mysqli->error);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="index.php">Home</a>
 <a href="dashboard.php">Insert New Record</a>
 <a href="logout.php">Logout</a></p>
<h2>View Records</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>S.No</strong></th>
<th><strong>User</strong></th>
<th><strong>Course</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
$count = 1;
while ($row = mysqli_fetch_assoc($result)) {?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["username"]; ?></td>
<td align="center"><?php echo $row["course"]; ?></td>
<td align="center">
<a href="dashboard.php?edit=<?php echo $row["id"]; ?>">Edit</a>
</td>
<td align="center">
<a href="dashboard.php?delete=<?php echo $row["id"]; ?>">Delete</a>
</td>
</tr>
<?php $count++;}?>
</tbody>

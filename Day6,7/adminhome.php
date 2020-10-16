<?php
  require ("connect.php");
  session_start();
  if(!isset($_SESSION))
	{
		header('location:adminlogin.php');
		exit;
	}
  $success="";
  $mail = $_SESSION['mail'];     
  $select = "Select * FROM students"; 
  $result = mysqli_query($conn, $select);
 
  if (mysqli_num_rows($result) > 0){

  }
  else echo "Error";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    
    td,h1,div{
    text-align: center;
    }
    
    </style>
</head>
<body>
<h1>Welcome Admin</h1>
<table border="1" cellpadding="15"   style="width: 100%; border-collapse: collapse; margin:0 auto">
  <thead>
    <tr>
      <th>Name</th>
      <th>PHP</th>
      <th>MYSQL</th>
      <th>HTML</th>
      <th>Total Obtained</th>
      <th>Percentage</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
      while($row = mysqli_fetch_assoc($result)){?>
      <tr>
        <td><?php echo $row['name']?></td>
          <td><?php echo $row['php']; ?></td>
          <td><?php echo $row['mysql']?></td>
          <td><?php echo $row['html']; ?></td>
          <td><?php echo $row['totalmarks'];?></td>
          <td><?php echo $row['percent']; ?></td>
          <?php $student_id=$row['id'] ?>
          <td><a href="edit.php?_id=<?php echo $student_id ?>">Edit</a> | <a href="delete.php?_id=<?php echo $student_id ?>">Delete</a></td>
        <tr>
    <?php } ?>
    </tr>
  </tbody>
</table>

<div style="padding: 100px;">
  <a href="addstudent.php"><button>Add new student</button></a>
</div>

<h1 ><?php echo $success ?></h1>
<a style="position:absolute; top:1em ;right:1em;" href="logout.php"><button>Logout</button></a>

</body>
</html>
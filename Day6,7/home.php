<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marksheet</title>
    <style>td,h1,div{
    text-align: center;
    }</style>
</head>
<body>
    <h1>Welcome <?php  echo $_SESSION['user'] ?></h1>
    
    <table border="1" cellpadding="15"   style="width: 50%; border-collapse: collapse; margin:0 auto">
      
      <thead>
        <tr>
          <th>Name</th>
          <th>PHP</th>
          <th>MYSQL</th>
          <th>HTML</th>
          <th>Total Obtained</th>
          <th>Percentage</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?php echo $_SESSION['user'] ?></td>
          <td><?php echo $php ?></td>
          <td><?php echo $mysql ?></td>
          <td><?php echo $html ?></td>
          <td><?php echo $totalobtained ?></td>
          <td><?php echo $percentage ?></td>
        </tr>
      </tbody>

    </table>
    <h1 ><?php echo $success ?></h1>
    
    <div>
      <form action="sendmail.php" method="POST">
      
      <label for="parent_email">Enter Parents Email :</label>
      <input type="email" name="parent_email"><br>
      
      <input type="submit" name="parent_submit">
      </form>
    </div>
    
    <a style="position:absolute; top:1em ;right:1em;" href="logout.php"><button>Logout</button></a>
</body>
</html>

<?php
  require ("connect.php");
  session_start();
  if(!isset($_SESSION))
	{
		header('location:login.php');
		exit;
	}
  $success="";
  $mail=$_SESSION['mail'];     
  $select = "Select * FROM students where students.email='$mail'"; 
  $result = mysqli_query($conn, $select);
 
  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        
        $php        = $row["php"];
        $mysql      = $row["mysql"];
        $html       = $row["html"];
        $totalmarks = $row['totalmarks'];
        $percent    = $row['percent'];
      }    
      
      if($percent>=60){
        $success="Congratulations You Passed!";
      }  
      else $success="Better Luck Next Time!"; 
  }
  // else echo "Error";

?>
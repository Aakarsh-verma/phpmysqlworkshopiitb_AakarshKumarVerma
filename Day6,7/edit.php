<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student's Details</title>
    <style>
    input{
        margin: 5px;
        }
    #submit{
        margin: 0 auto;
    }    
        </style>
</head>
<body>
    <h1>Edit Student's Details</h1>
        <form action="" method="post">
        
        <label for="name">Username :</label>
        <input type="text" name="name" value="<?php $name?>"required>
        <br>
        
        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php $email ?>" required>
        <br>
        
        <label for="Sub1">PHP :</label>
        <input type="text" name="Sub1" value="<?php $subject1 ?>" required>
        <br>
        
        <label for="Sub1">MYSQL :</label>
        <input type="text" name="Sub2" value="<?php $subject2 ?>" required>
        <br>
        
        <label for="Sub1">HTML :</label>
        <input type="text" name="Sub3" value="<?php $subject3 ?>" required>
        <br>
        
        <input type="submit" name="submit" id="submit">
        </form>
      <h3 style="text-align: center;"><?php echo $success; echo $error; ?></h3>  
            
</body>
</html>

<?php
require("connect.php");

session_start();
$success=$error="";

$current_id=$_GET['_id'];
$mail=$_SESSION['mail'];     

$select = "SELECT * FROM students where id='$current_id'"; 

$result = mysqli_query($conn, $select);
 
if (mysqli_num_rows($result) > 0) {   
    while($row = mysqli_fetch_array($result)) {
        $name=$row['name'];
        $email=$row['email'];
        $subject1=$row["mysql"];
        $subject2=$row["mysql"];
        $subject3=$row["html"];
    }      
}
else echo "Error";


if(isset($_POST['submit'])){
    
    $name   = (isset($_POST['name']) ? $_POST['name'] : null);
    $email  = (isset($_POST['email']) ? $_POST['email'] : null);
    $php    = (isset($_POST['php']) ? $_POST['php'] : null);
    $mysql  = (isset($_POST['mysql']) ? $_POST['mysql'] : null);
    $html   = (isset($_POST['html']) ? $_POST['html'] : null);
  
  if(!empty($name || $php || $mysql || $html || $email)){
      
    if(is_numeric($php) && is_numeric($mysql) && is_numeric($html) &&  $php<=100 && $mysql<=100 && $html<=100){ 
        
        $total   = $php + $mysql + $html;
        $percent = ($total/300) * 100 ; 
        $sql     = "UPDATE students SET php=$php, mysql=$mysql, html=$html, totalmarks=$total, percent=$percent WHERE id='$current_id'";
          
        if (mysqli_query($conn, $sql)) {
            header("Location : edit.php");
        } 
        else {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
      }

      else{
        echo "Enter Numeric Values less than 100 for The Subject Marks";
      }

  }
  else {
    echo "Please Enter all the values";
  }
  
}

?>
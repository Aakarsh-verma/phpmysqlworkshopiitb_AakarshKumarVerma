<?php
require("connect.php");
session_start();
$success=$error="";
$current_id=$_GET['_id'];
$mail=$_SESSION['mail'];     
$select = "Select * FROM marks,students where marks.student_id='$current_id' AND students.id='$current_id'"; 
$result = mysqli_query($conn, $select);
 
  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_array($result)) {
           $name=$row['name'];
          $email=$row['email'];
          $subject1=$row["mysql"];
          $subject2=$row["mysql"];
          $subject3=$row["html"];
      }      
  }
  else echo "Error";


  if(isset($_POST['submit']))
  {
  $name = (isset($_POST['name']) ? $_POST['name'] : null);
  $email = (isset($_POST['email']) ? $_POST['email'] : null);
  $Subject1 = (isset($_POST['php']) ? $_POST['php'] : null);
  $Subject2 = (isset($_POST['mysql']) ? $_POST['mysql'] : null);
  $Subject3 = (isset($_POST['html']) ? $_POST['html'] : null);
  
  if(!empty($name || $Subject1 || $Subject2 || $Subject3 || $email))
  {   
      if(is_numeric($Subject1) && is_numeric($Subject2) && is_numeric($Subject3) &&  $Subject1<=100 && $Subject2<=100 && $Subject3<=100)
      { 
          $totalobtained = $Subject1 + $Subject2 + $Subject3;
          $percentage = ($totalobtained / 300) * 100 ; 
          $sql = "UPDATE marks SET mysql=$Subject1,mysql=$Subject2,html=$Subject3,totalmarks=$totalobtained,percent=$percentage WHERE student_id='$current_id'";
          
          if (mysqli_query($conn, $sql)) {             
              header("Location : edit.php");
          } else {
              echo "Error: " . $sql . ":-" . mysqli_error($conn);
          }
          mysqli_close($conn);
      }    
      else{
          echo "Enter Numeric Values less than 100 for The Subject Marks";
      }
  }
  else
  {
      echo "Please Enter all the values";
  }
  
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
    <h1>Edit Student Details</h1>
        <form action="" method="post">
        Username <input type="text" name="name" value="<?php $name?>"required>
        <br>
        Email <input type="email" name="email" value="<?php $email ?>" required>
        <br>
        PHP <input type="text" name="Sub1" value="<?php $subject1 ?>" required>
        <br>
        MYSQl <input type="text" name="Sub2" value="<?php $subject2 ?>" required>
        <br>
        HTML <input type="text" name="Sub3" value="<?php $subject3 ?>" required>
        <br>
        <input type="submit" name="submit" id="submit">
        </form>
      <h3 style="text-align: center;"><?php echo $success; echo $error; ?></h3>  
            
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
    input{
        margin: 5px;
        }   
    </style>
</head>
<body>
    <h1>Admin Login</h1>
    <form action="" method="post">
    
    <label for="email">Email :</label>
    <input type="email" name="email" placeholder="Email" required>
    <br>

    <label for="passord">Password :</label>
    <input type="password" name="password" placeholder="Password" required>
    <br>
    
    <input style="margin: 0 auto;" type="submit" name="submit" id="submit">
    </form>
    <h3 style="text-align: center;"><?php echo $success; echo $error; ?></h3>  
            
</body>
</html>


<?php
require ("connect.php");
$success=null; 
$error=null;

$email=(isset($_POST['email']) ? $_POST['email'] : null );
$password=(isset($_POST['password']) ? $_POST['password'] : null );
if(isset($_POST['submit'])){
 
    if(!empty($email && $password)){
        $password=md5($password);
      
        $select = "SELECT * FROM admins where email='$email' and password='$password'"; 
        $result = mysqli_query($conn, $select);
       
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $name=$row['name'];      
                $mail=$row['email'];        
                session_start();
                $_SESSION['user'] = $name;
                $_SESSION['mail'] = $mail;
                header("location: adminhome.php");
            }       
        }
        else $error = "Your Login Name or Password is invalid";                          
    }
    else  $error="Input Values";
}    

?>
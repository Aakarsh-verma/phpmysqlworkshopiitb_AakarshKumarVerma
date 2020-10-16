<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
    input{
        margin: 5px;
        }   
        </style>
</head>
<body>
    <h1>Student Registration Form</h1>
    <form action="" method="post">
    
    <label for="name">Username :</label>
    <input type="text" name="name" value="<?php echo $name?>" placeholder="Username" required>
    <br>
    
    <label for="email">Email :</label>
    <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email" required>
    <br>
    
    <label for="passord">Password :</label>
    <input type="password" name="password" value="<?php echo $password ?>" placeholder="Password" required>
    <br>
    
    <label for="password2">Confirm Password :</label>
    <input type="password" name="password2" value="<?php echo $password2 ?>" placeholder="Confirm Password" required>
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
$name=(isset($_POST['name']) ? $_POST['name'] : null );
$email=(isset($_POST['email']) ? $_POST['email'] : null );
$password=(isset($_POST['password']) ? $_POST['password'] : null );
$password2=(isset($_POST['password2']) ? $_POST['password2'] : null );

if(isset($_POST['submit'])){
 
    if(!empty($name && $password && $email && $password2)){

        $compare = "SELECT * FROM students";
        $result = mysqli_query($conn, $compare);
        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                $stored_email=$row["email"];
                if($stored_email === $email){
                    die ("User already exists");
                }               
            }                          
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            if($password === $password2){
                
                $password=md5($password);
                $password2=md5($password2);
                
                $sql="INSERT into students (name,password,email) VALUES('$name','$password','$email');";
                
                if (mysqli_multi_query($conn, $sql)) {
                    do {
                        if ($result = mysqli_store_result($conn)) {
                            
                            while ($row = mysqli_fetch_row($result)) {
                                
                            }
                            mysqli_free_result($result);
                        }
                        
                        if (mysqli_more_results($conn)) {
                            echo "<script type='text/javascript'>alert('New user Added');
                            window.location='login.php';
                            </script>";
                        }

                    } while (mysqli_next_result($conn));
                } 
                else echo "Error: " . $sql . ":-" . mysqli_error($conn);
                mysqli_close($conn);    
            }
            else $error="Passwords Don't match";
        }
         else $error="Please enter a valid email";           
    }
    else  $error="Input Values";
}

?>
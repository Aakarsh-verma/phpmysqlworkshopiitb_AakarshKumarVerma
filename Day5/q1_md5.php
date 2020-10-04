<html>
<body>
<form action="" method="POST">
	<input type="text" name="name" placeholder="USERNAME"><br>
	<input type="password" name="password" placeholder="PASSWORD"><br>
	<input type="submit"  name="submit" value="save details">

</form>
</body>
</html>
<?php
    require ("connect.php");

    if(isset($_POST['submit'])){
        $name=(isset($_POST['name']) ? $_POST['name'] : null );
        $password=(isset($_POST['password']) ? $_POST['password'] : null );
        
        if(!empty($name && $password)){

            $compare = "SELECT * FROM users where username='$name'";
            if ($conn->query($compare) === TRUE){
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        $stored_name=$row["username"];
                        if($stored_name === $name){
                            die ("Username already taken");
                            // mysqli_close($conn);
                        }            
                    }
                }
            }else
            $password=md5($password);
            $sql="INSERT into users (username, password) VALUES('$name','$password')";
            if (mysqli_query($conn, $sql)) {
                echo "<br>";
                echo "New User has been added successfully !";
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($conn);
            }
            mysqli_close($conn);           
        }
        else echo "Input Values";
        
    }   
?>
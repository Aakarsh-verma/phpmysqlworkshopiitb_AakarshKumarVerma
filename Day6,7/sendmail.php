<?php
    require ("connect.php");
    session_start();
    $success="";
    $mail=$_SESSION['mail'];  
    $sname=$_SESSION['user'];   
    
    $select = "Select * FROM students where students.email='$mail'"; 
    $result = mysqli_query($conn, $select);
    
    if(isset($_POST['parent_submit'])){ 
        
        $parent_email=(isset($_POST['parent_email']) ? $_POST['parent_email'] : null );
        
        if (mysqli_num_rows($result) > 0) {
            
            while($row = mysqli_fetch_assoc($result)) {
            $php        = $row["php"];
            $mysql      = $row["mysql"];
            $html       = $row["html"];
            $totalmarks = $row['totalmarks'];
            $percent    = $row['percent'];
            
            $to         = $parent_email;
            $subject    ="$sname's Marksheet";
            $headers    ="From: akv012000@gmail.com";
            nl2br("New line \n in this string\r\n");
            $body=" PHP : $php \n MYSQL : $mysql \n HTML : $html \n Total : $totalmarks \n Percentage : $percent";
                        
            mail($to,$subject,$body,$headers);      
            echo "Mail Sent Successfully";
                  
            }    
        }                  
    }
    else echo "Please input all the parameters";
      
?>
<html>

	<form action="q6_2_special_variables_html.php" method='POST'>
    <h3>Enter Your Details</h3>
    <label for="name">Name of Student:</label>
	<input type='text' name='name' ><br/><br>
    
    <legend>Marks in each Subject (out of 100)</legend><br>
	
    <label for="sub1">Subject 1:</label>
	<input type='number' name='sub1' ><br/><br>
	
    <label for="sub2">Subject 2:</label>
	<input type='number' name='sub2' ><br /><br>
	
    <label for="sub3">Subject 3:</label>
	<input type='number' name='sub3' ><br /><br>
    
    <label for="sub4">Subject 4:</label>
	<input type='number' name='sub4' ><br /><br>
    
    <label for="sub5">Subject 5:</label>
	<input type='number' name='sub5' ><br /><br>
    
    <input type='submit' value='Submit'/>
	</form>

<?php
    @$name = $_POST['name'];
    @$s1 =$_POST['sub1'];
    @$s2 =$_POST['sub2'];
    @$s3 =$_POST['sub3'];
    @$s4 =$_POST['sub4'];
    @$s5 =$_POST['sub5'];

    $sum = $s1 + $s2 + $s3 + $s4 + $s5;
    $per = ($sum/500)*100;
    if($name && $s1 && $s2 && $s3 && $s4 && $s5){
        echo "
        <h3>Report</h3>
        <label>Student Name:</labe>$name<br>
        <label>Subject 1: </label>$s1<br>
        <label>Subject 1: </label>$s1<br>
        <label>Subject 2: </label>$s2<br>
        <label>Subject 3: </label>$s3<br>
        <label>Subject 4: </label>$s4<br>
        <label>Subject 5: </label>$s5<br>
        <label>Total Marks Obtained:</label>$sum<br>
        <label>Total Marks: </label>500<br>
        <label>Percentage: </label>$per%<br>"
        ;
    }
    else{
        echo "You missed some of the above fields."
    }
?>


</html>
<html>

	<form method='GET'>
	
	<label for="side1">Side 1:</label>
	<input type='number' name='side1' ><br/><br>
	
	<label for="side1">Side 2:</label>
	<input type='number' name='side2' ><br /><br>
	
	<label for="side1">Side 3:</label>
	<input type='number' name='side3' ><br /><br>
	
	<input type='submit' value='Submit' />
	</form>

	<?php
	if(isset($_GET['side1']) && isset($_GET['side1']) && isset($_GET['side1'])){
		$s1 =$_GET['side1'];
		$s2 =$_GET['side2'];
		$s3 =$_GET['side3'];
		
		if($s1 && $s2 && $s3){
			if($s1 == $s2 && $s2 == $s3){
				echo "Triangle is Equilateral";
			}
			else if(($s1 == $s2 && $s2 != $s3) || 
					($s1 != $s2 && $s2 == $s3) ||
					($s1 == $third && $s2 != $s3)){
				echo "Triangle is Isoceles";
			}
			else if((($s1**2+$s2**2)==$s3**2) || 
					(($s3**2+$s2**2)==$s1**2) || 
					(($s1**2+$s3**2)==$s2**2) ){
				echo "Triangle is Right Angled";
			}
			else{
				echo "Triangle is scalene";
			}
		}
	}
	else{
        echo "A field was left empty";
    }
	?>

</html>
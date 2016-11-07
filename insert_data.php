<?php
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$conn=new mysqli("localhost","root","","tests");
		$sql="SELECT * FROM test_for";
		$num=$_POST['nid'];
		$sql.=$num;
		$result=$conn->query($sql);
		$sql1="SELECT column_name FROM template_for$num";
		$result_col=$conn->query($sql1);		
		echo "       ";
		/*while($row1=$result_col->fetch_assoc())
		{
			$name=$row1['column_name'];					
			echo $name."\t";
		}
		echo "<br>";
		echo "<form method=\"get\" action=\"insert_data.php\">";
		while($row=$result->fetch_assoc())
		{
			$result_col=$conn->query($sql);		
			while($row1=$result_col->fetch_assoc())
			{
				$name=$row1['column_name'];					
				//echo $row[$name]."\t";
				echo "<input type=\"text\" value=\"$row[$name]\"></input>"; 
			}
			echo "<br>";		
		}*/
		$row=$result_col->fetch_assoc();
		echo "<pre>";
		echo "\t";
		while($row1=$result->fetch_assoc())
			{
				$name=$row['column_name'];
				echo "\t\t";
				echo $row1[$name];				
			}
		echo "<br>";
		while($row=$result_col->fetch_assoc())
		{
			echo "<form name=\"submitting\" method=\"get\" action=\"insert_data.php\">";
			echo $row['column_name'];
			echo "\t";
			$name=$row['column_name'];
			$result=$conn->query($sql);
			while($row1=$result->fetch_assoc())
			{
				$user=$row1['username'];
				//echo $row1[$name];
				echo "<input type=\"text\" name=\"$user\" value=\"$row1[$name]\">";
				echo "</input>";				
			}
			echo "<input type=\"hidden\" name=\"screening\" value=\"$name\"></input>";			
			echo "<input type=\"hidden\" name=\"notif\" value=\"$num\"></input>";
			echo "<input type=\"submit\" value=\"submit\"></input>"; 
			echo "<br>";
			echo "</form>";
		}
		echo "<pre>";
		$conn->close();
	}
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		echo "yeah";
		$co=$_GET['screening'];
		$num=$_GET['notif'];
		$conn =new mysqli("localhost","root","","tests");
		$sql="SELECT username FROM test_for$num";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
		{
			$val=$_GET[$row['username']];
			$val1=$row['username'];
			$sql="UPDATE test_for$num SET $co='$val' WHERE username='$val1'";
			if($conn->query($sql))
			{
				echo "lkdsbs";
			}	
			else
			{
				echo $conn->error;
			}
		}	
	}
?>
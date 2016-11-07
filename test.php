<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{	
		$id=$_POST['id'];
		$cols=$_POST['number'];
		$i=0;
		echo "<form method=\"get\" action=\"test.php\">";
		for($i=0;$i<$cols;$i++)
		{
			$name="test_".$i;
			echo "Name of test no.$i";
			echo "<input type=\"text\" name=\"$name\"></input><br>";
		}
		echo "<input type=\"hidden\" name=\"col\" value=\"$cols\"></input>";
		echo "<input type=\"hidden\" name=\"id\" value=\"$id\"></input>";
		echo "<input type=\"submit\"></input>";
		echo "</form>";	
	}
	if($_SERVER["REQUEST_METHOD"]=="GET")
	{
		$c=$_GET['col'];
		$id=$_GET['id'];
		for($i=0;$i<$c;$i++)
		{	
			$name="test_".$i;
			$name=$_GET[$name];
			echo $name."<br>";
		}
		$conn =new mysqli("localhost","root","","tests");
		$sql="CREATE TABLE test_for";
		$sql.=$id;
		$sql.="(username VARCHAR(30)";
		for($i=0;$i<$c;$i++)
		{
			$name="test_".$i;
			$name=$_GET[$name];
			$sql.=",";
			$sql.=$name;
			$sql.=" INT(10) DEFAULT '0'";
		}
		$sql.=")";
		if($conn->query($sql)===TRUE)
		{
			echo "test generated";
		}
		else
		{
			echo $conn->error;
		}
		$sql="CREATE TABLE template_for$id(column_name VARCHAR(30))";
		$conn->query($sql);
		$sql="INSERT INTO template_for$id(column_name) VALUES('username')";
		$conn->query($sql);
		for($i=0;$i<$c;$i++)
		{
			$name="test_".$i;
			$name=$_GET[$name];
			$sql="INSERT INTO template_for$id(column_name) VALUES('$name')";
			if($conn->query($sql)===TRUE)
			{
				echo "success";	
			}
			else
			{
				echo $conn->error;		
			}
		}
		$conn1 =new mysqli("localhost","root","","online_recruitment");
		$sql="SELECT username FROM applies_for WHERE notification_id='$id'";
		$result=$conn1->query($sql);
		while($row=$result->fetch_assoc())
		{
			$name=$row['username'];
			$sql="INSERT INTO test_for$id(username) VALUES('$name')";
			if($conn->query($sql))
			{
				echo "lala";	
			}
			else
			{
				echo $conn->error;
			}
		}
		$conn1->close();
		$conn->close();	
	}
?>
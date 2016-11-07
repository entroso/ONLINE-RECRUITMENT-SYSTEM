<html>
<link rel="stylesheet" type="text/css" href="trial_css.css">
<h1>
My Home Page
</h1>
<br>
<br>
<br>
<?php
	session_start();
	if(isset($_SESSION['username']))
{
	$user=$_SESSION['username'];
	$conn=new mysqli("localhost","root","","online_recruitment");
	$sql="SELECT username,name,contact_no,email_id FROM applicant WHERE username='$user'";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		echo "<br>Name : ".$row['name']."<br>";
		echo "<br>Username : ".$row['username']."<br>";
		echo "<br>Email_id : ".$row['email_id']."<br>";
		echo "<br>Contact_no. : ".$row['contact_no']."<br>";
	}
	$sql="SELECT * FROM notification";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		echo "<form method=\"post\" action=\"applicant_home.php\">";
		echo "<br>".$row['job_description']."<br>";
		$nid=$row['notification_id'];
		echo "<input type=\"hidden\" name=\"id\" value=\"$nid\"></input>";
		echo "<input type=\"submit\" value=\"apply\"></input>";
		echo "</form><br>";
	}
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$aid=$_SESSION['username'];
		$nid=$_POST['id'];
		$name="test_for".$nid;
		$sql="INSERT INTO applies_for(notification_id,username) VALUES('$nid','$aid')";
		if($conn->query($sql)===TRUE)
		{
			echo "success";	
		}
		else
		{	
			echo $conn->error;
		}
		echo "<br>";
		$conn1=new mysqli("localhost","root","","tests");
		if ($conn->query ( "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'tests' AND table_name ='$name'" )->fetch_assoc())
		{
			$sql="INSERT INTO test_for$nid(username) VALUES('$aid')";
			if($conn1->query($sql))
			{
				echo "ssldknv";
			}
			else
			{
				echo $conn1->error;
			}			
		}
		else
		{
			echo $conn->error;
		}
		$conn1->close();
	}
	$conn->close();
}
?>
<a style="
	display : block;
	position : relative;
	width : 40px;
	background-color : blue;
    color: white;
    text-align: center;
    padding: 11px 12px;
	font-size : 15px;
    text-decoration: none;
" href="uploader.php">Upload Resume</a>
<html>
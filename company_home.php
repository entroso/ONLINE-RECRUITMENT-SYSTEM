<html>
<link rel="stylesheet" type="text/css" href="trial_css.css">
<h1>
Company's home page
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
		$sql="SELECT username,name,contact_no,email_id FROM company WHERE username='$user'";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
		{
			echo "<br>Name : ".$row['name']."<br>";
			echo "<br>Username : ".$row['username']."<br>";
			echo "<br>Email_id : ".$row['email_id']."<br>";
			echo "<br>Contact_no. : ".$row['contact_no']."<br>";
		}
		echo "<br><br><br>";
		$sql="SELECT job_description,notification.notification_id FROM notification INNER JOIN posts ON notification.notification_id=posts.notification_id WHERE posts.username='$user'";
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc())
		{
			$num=$row['notification_id'];	
			
			//echo "<b><i>$user : </i></b>";
			echo $row['job_description']."<br>";
			$name="test_for".$num;
			echo "<form method=\"post\" action=\"view_applicants.php\">";
			echo "<input type=\"hidden\" name=\"notif\" value=\"$num\"></input>";
			echo "<input type=\"submit\" name=\"submit\" value=\"View Applicants\"></input>";
			echo "</form>";
			if ($conn->query ( "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'tests' AND table_name ='$name'" )->fetch_assoc()) {
			    	echo "<form method=\"post\" action=\"insert_data.php\">";
				echo "<input type=\"hidden\" name=\"nid\" value=\"$num\"></input>";
				echo "<input type=\"submit\" value=\"Insert test marks\"></input>";
				echo "</form>";
			} else {
				echo "<form method=\"post\" action=\"test.php\">";				
				echo "<b>Prepare screening processes</b><br>";
				echo "No. of screening processes : ";
				echo "<input type=\"hidden\" name=\"id\" value=\"$num\"></input>";
				echo "<input type=\"text\" name=\"number\"></input>";
				echo "<input type=\"submit\"></input>";
				echo "</form>";
			}									
		}
		$conn->close();							
	}
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$conn=new mysqli("localhost","root","","online_recruitment");
		//echo $_POST['job_description']."<br>";
		$job=$_POST['job_description'];
		$date = date('Y-m-d H:i:s');
		$sql="INSERT INTO notification(job_description,start_date) VALUES('$job','$date')";
		if($conn->query($sql)===TRUE)
		{		
			$cid=$_SESSION['username'];
			$last_id=$conn->insert_id;
			$sql="INSERT INTO posts(notification_id,username) VALUES('$last_id','$cid')";
			$conn->query($sql);
		}
		else
		{
			echo $conn->error;
		}
		$conn->close();		
	}	
?>
<form method="post" action="company_home.php">
<textarea rows="4" cols="40" name="job_description"></textarea>
<input type="submit" value="create notification"></input>
</form>
<html>
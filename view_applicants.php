<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$nid=$_POST['notif'];
	$conn=new mysqli("localhost","root","","online_recruitment");
	$sql="SELECT * FROM applicant INNER JOIN applies_for ON applicant.username=applies_for.username WHERE notification_id='$nid'";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		echo "<br>Name : ".$row['name']." ";
		echo "\tUsername : ".$row['username']." ";
		echo "Email_id : ".$row['email_id']." ";
		echo "Contact_no. : ".$row['contact_no']."    ";
		$resume=$row['resume'];
		echo "<a href=\"$resume\">Download Resume</a>";
	}
	$conn->close();
}
?>
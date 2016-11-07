<html>
<title>Company</title>
<link rel="stylesheet" type="text/css" href="trial_css.css">
<div align="center">
<h1>Create your Company's Account</h1>
</div>
<form method="post" action="companies.php" align="center">
	<br>
	Name : <input type="text" name="name" />
	<br><br>
	Username : <input type="text" name="username" />
	<br><br>
	Password : <input type="password" name="password" />
	<br><br>
	Address : <input type="text" name="address" />
	<br><br>
	Email-id : <input type="text" name="email_id" />
	<br><br>
	Contact No. : <input type="text" name="contact_no" />
	<br><br>
	<input type="submit" name="create" value ="create" />
	<br><br>
</form>
</html>
<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
	echo "Account with following details created<br>";
	$name=$_POST['name'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$address=$_POST['address'];
	$email_id=$_POST['email_id'];
	$contact_no=$_POST['contact_no'];
	$conn=new mysqli("localhost","root","","online_recruitment");
	if($conn->connect_error)
	{
		die("connection failed : ".$conn->connect_error);
	}
	$sql="INSERT INTO company(name,username,password,address,email_id,contact_no) VALUES	('$name','$username','$password','$address','$email_id','$contact_no')";
	if($conn->query($sql)===TRUE)
	{
		//echo "company details successfully entered";
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['type']='company';
		$conn->close();	
		header("Location: home_page.php");
	}
	else
	{
		echo $conn->error;
	}
	echo "<br>";
	$conn->close();
}
?>
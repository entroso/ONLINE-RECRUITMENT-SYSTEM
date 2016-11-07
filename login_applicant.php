<html>
<link rel="stylesheet" type="text/css" href="trial_css.css">
<form align="center" method="post" action="login_applicant.php">
<br>
Username : <input type="text" name="username"></input><br>
Password : <input type="password" name="password"></input><br>
<input align="center" type="submit" value="login"></input><br><br>
</form>
</html>
<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$conn=new mysqli("localhost","root","","online_recruitment");
	if($conn->connect_error)
	{
		die("connection failed : ".$conn->connect_error);
	}
	else
	{
		//echo "Connection created";
	}
	echo "<br>";
	$sql="SELECT name,username FROM applicant WHERE username='$username' AND password='$password'";
	$result=$conn->query($sql);
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['type']='applicant';
		//echo $_SESSION['username'];
		//echo "<br>";
		header("Location: home_page.php");
	}
	else
	{
		echo "incorrect<br>";
	}	
	$conn->close();
}
?>
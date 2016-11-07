<html>
  <title>
    ONLINE RECRUITMENT SYSTEM
  </title>
	<!--<h1 align="center">ONLINE RECRUITMENT SYSTEM</h1>-->
	<ul>
		<li style="float : left;"><a href="home_page.php" style="font : 31px arial, sans-serif;">ONLINE RECRUITMENT SYSTEM</a></li>
		<li><a href="applicants.php">Searching for <br>jobs</a></li>
		<li><a href="companies.php">Register your <br>company</a></li>
		<?php
		session_start();
	if(isset($_SESSION['username'])&&$_SESSION['type']=='company')
	{
		echo "<li><a href=\"logout.php\">"."<br>Logout"."</a></li>";
		echo "<li><a href=\"company_home.php\">"."Hi <br>".$_SESSION['username']."</a></li>";		
   	}
	else
	{
		echo "<li><a href=\"login_company.php\">"."Sign In as <br>company"."</a></li>";
	}
?>
		<!--<li><a href="login_company.php">Sign in as <br>company</a></li>-->
		<?php
	if(isset($_SESSION['username'])&&$_SESSION['type']=='applicant')
	{
		echo "<li><a href=\"logout.php\">"."<br>Logout"."</a></li>";
		echo "<li><a href=\"applicant_home.php\">"."Hi <br>".$_SESSION['username']."</a></li>";		
   	}
	else
	{
		echo "<li><a href=\"login_applicant.php\">"."Sign In as <br>applicant"."</a></li>";
	}
?>

		<!--<li><a href="login_applicant.php">Sign in as <br>applicant</a></li>	-->	
	</ul>
	<link rel="stylesheet" type="text/css" href="trial_css.css">
  <!--<br>
	<br>
	<br>
	<br>
	<br>
	<br>
<?php
	session_start();
	if(isset($_SESSION['username'])&&$_SESSION['type']=='applicant')
	{
		echo "<a class=\"key\" href=\"applicant_home.php\">".$_SESSION['username']."</a>";
		echo "<br>";
		echo "<a class=\"key\" href=\"logout.php\">"."Logout"."</a>";
   	}
	else
	{
		echo "<a class=\"key\" href=\"login_applicant.php\">"."Sign In as applicant"."</a>";
		echo "<br>";
	}
?>
<br>
<?php
	$servername=$_SERVER['SERVER_NAME'];
	if(isset($_SESSION['username'])&&$_SESSION['type']=='company')
	{
		echo "<a class=\"key\" href=\"company_home.php\">".$_SESSION['username']."</a>";
		echo "<br>";
		echo "<a class=\"key\" href=\"logout.php\">"."Logout"."</a>";
   	}
	else
	{
		echo "<a class=\"key\" href=\"login_company.php\">"."Sign In as company"."</a>";
		echo "<br>";
	}
?>
  <br>
  <br>
  <a class="key" href="companies.php">
    Register your Company
  </a>
  <br>
  <br>
  <a class="key" href="applicants.php">
      Searching for jobs
  </a>
</html>
<?php
	echo $servername;
	//$conn= new mysqli("localhost","root","","online_recruitment");
	$conn= new mysqli($servername,"root","","online_recruitment");
	$sql="SELECT * FROM notification";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		echo "<br>".$row['job_description']."<br>";
	}
	$conn->close();
?>-->

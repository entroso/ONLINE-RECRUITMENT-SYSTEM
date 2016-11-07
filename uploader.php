
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="trial_css.css">
<body>

<form action="resume_upload.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Resume" name="submit">
	<?php
		session_start();
		$user=$_SESSION['username'];
		echo "<input type=\"hidden\" name=\"uid\" value=\"$user\"></input>";
	?>
</form>

</body>
</html>
<?php
if (isset($_POST['cnx'])){
    header('Location: connection.php');
}else 
{
    if (isset($_POST['insc'])){
        header('Location: inscription.php');
    }
}
?>
<!DOCTYPE html >
<html> 
<head>
	<title>inscription ou connection</title>
	<meta charset="utf-8">
</head>
<body>
	<form method="POST" action="">
		<div align="center">
			<br><br>
			<h1>Welcome to miniChat</h1>
			<br><br>
			<input type="submit" name="insc" value="inscription">
			<br><br>
			<input type="submit" name="cnx" value="connection">
		</div>
	</form>
</body>
</html>

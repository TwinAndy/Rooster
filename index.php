<?php
require 'php/kalender.php';

if(session_status()!=PHP_SESSION_ACTIVE) {
	session_start();
}
//Als SESSION een u_id heeft dan doorgestuurd naar dashboard.php
if(isset($_SESSION['userId'])){
	header("Location: dashboard.php");
}
//HOST = GEARHOST.
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Log in</title>
	</head>
	<body>
		<div class="login">
			<div class="form">

				<form class="login-form" method="POST" action="php/login.php">
					<p class="title">Log in</p>
					<input type="text" name="uid" placeholder="E-mail"/>
					<input type="password" name="pass" placeholder="Password"/>
					<button type="submit" name="login-submit">Log in</button>
				</form>
				<a href="register.php">Sign up</a>



			</div>
		</div>
		<!--
		KALENDER OPSTELLEN :    $kalender = new Kalender([maand], [jaar])
		KALENDER VISUALISEREN:	$kalender->show();
	-->
	<!--
		<?php
		$kalender = new Kalender(12,2018);
		$kalender->show();
		?>
	<br>
	<br>
	<?php
	$kalender = new Kalender(6, 2018);
	$kalender->show();
	?>
	<br>
	<br>
	<?php
	$kalender = new Kalender(1,2018);
	$kalender->show();
	?>
-->
	</body>
</html>

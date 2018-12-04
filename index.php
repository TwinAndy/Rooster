<?php
require 'kalender.php';
?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
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
	</body>
</html>

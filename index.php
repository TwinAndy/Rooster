<?php
require 'kalender.php';
?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<?php
		$kalender = new Kalender(10,2018);
		$kalender->show();
		?>
	</body>
</html>

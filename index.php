<?php
class Kalender {
	private $maand;
	private $jaar;
	private $dagen_vd_week;
	private $aantal_dagen;
	private $datum_info;
	private $dag_vd_week;

	public function __construct( $maand, $jaar, $dagen_vd_week = array( 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag' ) ){
		$this->maand = $maand;
		$this->jaar = $jaar;
		$this->dagen_vd_week = $dagen_vd_week;
		$this->aantal_dagen = cal_days_in_month( CAL_GREGORIAN, $this->maand, $this->jaar );
		$this->datum_info = getdate( strtotime('first day of', mktime( 0,0,0,$this->maand,1,$this->jaar) ) );
		$this->dag_vd_week = $this->datum_info['wday'];
		$this->dag_vd_week;
	}
	public function show(){
		// Maand en Jaar titel
		$output = '<table class="kalender">';
		$output .= '<caption>' . $this->datum_info['maand'] . ' ' . $this->jaar . '</caption>';
		$output .= '<tr>';

		//Dagen van de week header
		foreach ( $this->dagen_vd_week as $dag ){
			$output .= '<th class="header">' . $dag . '</th>';
		}

		$output .= '</tr><tr>';

		//start bij dag van de week
		if ($this->dag_vd_week < 0){
			$output .= 'td colspan="' . 6 . '"></td>';
		}else if($this ->dag_vd_week > 0){
			//hier moet misschien --$this
			$output .= '<td colspan="' . $this->dag_vd_week . '"></td>';
		}

		$vandaag = 1;

		while ( $vandaag <= $this->aantal_dagen ){
			if ( $this->dag_vd_week == 7 ) {
				$this->dag_vd_week = 0;
				$output .= '</tr><tr>';
			}

			$output .= '<td class="dag">' . $vandaag . '</td>';

			$vandaag++;
			$this->dag_vd_week++;
		}

		if ( $this->dag_vd_week != 7){
			$overgebleven = 7 - $this->dag_vd_week;
			$output .= '<td colspan="'. $overgebleven . '"></td>';
		}

		$output .= '</tr>';
		$output .= '</table>';

		echo $output;
	}
}
?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<?php
		$kalender = new Kalender(11,2018);
		$kalender->show();
		?>
	</body>
</html>

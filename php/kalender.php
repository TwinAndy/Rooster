<?php
class Kalender {
	private $maand;
	private $jaar;
	private $dagen_vd_week;
	private $aantal_dagen;
	private $datum_maand;
	private $dag_vd_week;
/*
	public function __construct($maand, $jaar, $dagen_vd_week = array('Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag')){
		$this->maand = $maand;
		$this->jaar = $jaar;
		$this->dagen_vd_week = $dagen_vd_week; //Dagen namen
		$this->aantal_dagen = cal_days_in_month(CAL_GREGORIAN, this->maand, $this->jaar);
		$this->
	}*/
	public function __construct( $maand, $jaar, $dagen_vd_week = array( 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag' ) ){
		$this->maand = $maand;
		$this->jaar = $jaar;
		$this->dagen_vd_week = $dagen_vd_week;
		$this->aantal_dagen = cal_days_in_month( CAL_GREGORIAN, $this->maand, $this->jaar );
		$this->datum_info = getdate(mktime(0,0,0,$this->maand,1,$this->jaar));
		$this->dag_vd_week = $this->datum_info['wday'];
		//$this->datum_maand = date("F", mktime(0,0,0, $this->maand + 1, 0, 0));
	}
	public function show(){
		echo 'maand nummer' . $this->maand . 'jaar' . $this->jaar . $this->dagen_vd_week . 'aantal dagen' . $this->aantal_dagen . 'maand naam' . $this->datum_info['month'] .  'eerste dag' . $this->dag_vd_week;
		// Maand en Jaar titel
		$output = '<table class="kalender">';
				//Maand naam word niet laten zien
		$output .= '<caption>' . $this->datum_info['month']/*[month]*/ . ' ' . $this->jaar . '</caption>';
		$output .= '<tr>';

		//Dagen van de week header
		foreach ( $this->dagen_vd_week as $dag ){
			$output .= '<th class="header">' . $dag . '</th>';
		}

		$output .= '</tr><tr>';


		//als eerste dag niet maandag is dan opvullen met niks.
		if($this->dag_vd_week > 1){
			$output .= '<td colspan=' . --$this->dag_vd_week . '"></td>';
		}else if($this->dag_vd_week == 1){
			$this->dag_vd_week--;
		}

		$vandaag = 1;

		while ( $vandaag <= $this->aantal_dagen ){
			if ( $this->dag_vd_week == 7 ) {
				$this->dag_vd_week = 0;
				$output .= '</tr><tr>';
			}
			//elke keer een nieuwe class
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

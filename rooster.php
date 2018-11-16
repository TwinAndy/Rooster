class Kalender {
	private $maand;
	private $jaar;
	private $dagen_vd_week;
	private $aantal_dagen;
	private $datum_info;
	private $dag_vd_week;

	public function __construct( $maand, $jaar, $dagen_vd_week = array( 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', Zaterdag', 'Zondag' ) ){
		$this->maand = $maand;
		$this->jaar = $jaar;
		$this->dagen_vd_week = $dagen_vd_week;
		$this-> aantal_dagen = cal_days_in_month( CAL_GREGORIAN, $this->maand, $this->jaar );
		$this->datum_info = getdate( strtotime( mktime( 0,0,0,$this->maand,1,$this->jaar) ) );
		$this->dag_vd_week = $this->datum_info['wday'];
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
		//
	}
}

<?php

function build_kalender($maand, $jaar, $datumArray){
  $dagenVdWeek = array('Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag','Zondag');
  $eersteDag = mktime(0,0,0,$maand,1,$jaar);
  $aantalDagen = date('t', $eersteDag);
  $datumCom = getdate($eersteDag);
  $maandNaam = $datumCom['month'];
  $dagVdWeek = $datumCom['wday'];

  $kalender = "<table class='kalendar'>";
  $kalender .= "<caption>$maandNaam $jaar</caption>";
  $kalender .= "<tr>";

  foreach($dagenVdWeek as $dag){
    $kalender .= "<th class='header'>$dag</th>";
  }

  $vandaag = 1;

  $kalender .= "</tr><tr>";

  if($dagVdWeek > 0){
    $kalender .= "<td colspan='$dagVdWeek'&nbsp;</td>"
  }

  $maand = str_pad($maand, 2, "0", STR_PAD_LEFT)

  while($vandaag <= $aantalDagen){
    //Nieuwe kolumn
    if($dagVdWeek == 7){
      $dagVdWeek = 0;
      $calendar .= "</tr><tr>";
    }
    $vandaagRel = str_pad($vandaag, 2, "0", STR_PAD_LEFT);
    $datum = "$jaar-$maand-$vandaagRel";
    $kalender .= "<td class='dag' rel='$datum'>$vandaag</td>";

    $vandaag++;
    $dagVdWeek++;
  }

  if($dagVdWeek != 7){
    $overgebleven = 7 - $dagVdWeek;
    $kalender .= "<td colspan='$overgebleven'>&nbsp;</td>";
  }
  $kalender .= "</tr>";
  $kalender .= "</table>";

  return $kalender;
}
?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		
	</body>
</html>


<!DOCTYPE HTML>
<html>
  <head>
    <title>Registreer werknemer</title>
  </head>
  <body>
    <div class="register">
      <div class="form">
        <form action="php/register.php" method="POST">
          <input type="text" name="mail" placeholder="E-mail">
          <input type="text" name="first" placeholder="Voornaam">
          <input type="text" name="last" placeholder="Achternaam">
          <input type="checkbox" name="afwas" value="afwas" />Afwas
          <input type="checkbox" name="bediening" value="bediening" />Bediening
          <input type="checkbox" name="keuken" value="keuken" />Keuken
        </form>
      </div>
    </div>
  </body>
</html>


<!--
  STAP 1.
  Werkgever vult email, voor- en achternaam, geboortedatum,
  werkgroep, tijdelijk wachtwoord

  STAP 1.1
  Werkgever wordt doorgestuurd naar profiel pagina van Werknemer
  Werkgever deelt de werknemer in in werkgroepen

  STAP 2.
  Werknemer krijg mail om te verificeren met tijdelijk wachtwoord,
  eerste login gevraagd om wachtwoord te veranderen

-->

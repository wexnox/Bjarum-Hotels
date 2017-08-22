<?php
include 'start.php';
include 'nav.php';
?>

<div class="container">
     <div class="contact">
       <div class="row">
       	<div class="col-sm-12">

<?php
@$rid=$_GET['rid'];
@$fra=$_GET['f'];
@$til=$_GET['t'];
if(isset($rid, $fra, $til)) {
	@$go=$_POST['go'];
	include('db-tilkobling.php');
	$sqlsetning="SELECT r.nr, rt.beskrivelse, rt.max_gjester, h.navn FROM rom r
				JOIN rom_type rt ON r.rom_type_id = rt.id
				JOIN hotell h ON r.hotell_id=h.id
				WHERE r.id = $rid";
	$sqlres=mysqli_fetch_array(mysqli_query($db, $sqlsetning));
	$rnr=$sqlres[0];
	$rbesk=$sqlres[1];
	$rantgjest=$sqlres[2];
	$hnavn=$sqlres[3];

  print('<div class="col-sm-6 col-sm-offset-3">');
  print('<div class="spacer">');
  print('<h2>Bestilling</h2>');
  print('<hr>');
  print('<h4>Hotell: ' .$hnavn. '</h4>');
  print('<h4>Rom nr: ' . $rnr . '<br><br>' . $rbesk . ' for ' . $rantgjest . ' person(er)</h4>');
  print('<h4>Fra: <input type="text" value="' .$fra. '" disabled></h4>');
  print('<h4>Til: <input type="text" value="' .$til. '" disabled></h4>');


	if ($go) {
		$fnavn=$_POST['fnavn'];
		$enavn=$_POST['enavn'];
		$ref=$_POST['ref'];

		$sqlres=mysqli_fetch_array(mysqli_query($db, "SELECT MAX(id) FROM reservasjon;"));
		$maxid=$sqlres[0]+1;
		$sqlsetning=" INSERT INTO reservasjon
					VALUES($maxid, '$fra', '$til', $rid, '$fnavn', '$enavn', '$ref');";

		//$sqlsetning = "UPDATE rom SET tilstand = 'Opptatt' WHERE rom.nr = '$rnr';";


		$sqlresultat=mysqli_query($db,$sqlsetning) or die ("Klarte ikke å registrere reservasjonen");
		print('<br><br>Din bestilling er registrert<br><br>TA VARE PÅ FØLGENDE INFORMASJON:<br> Referanse-ID: ' .$maxid. '<br>Referansenøkkel: ' .$ref);
	} else {

    print('<form method="POST" action="">');
    print('<div class="form-group">');
    print(' <input type="text" class="form-control" id="fnavn" name="fnavn" placeholder="Fornavn" autofocus>');
    print('</div>');
    print('<div class="form-group">');
    print(' <input type="text" class="form-control" id="enavn" name="enavn" placeholder="Etternavn">');
    print('</div>');
    print('<div class="form-group">');
    print(' <input type="text" class="form-control" id="ref" name="ref" placeholder="Ønsket referansenøkkel">');
    print('</div>');
    print('<button type="submit" class="btn btn-default" id="go" name="go" value="Reserver">Reserver</button><br><br>');
    print("<a class='btn btn-default' href='index.php'>Tilbake</a>");
    print('</form>');
    print('</div>');
    print('</div>');
	}

}
else print('<b>Noe gikk feil</b>, gå <a href="index.php">tilbake</a> og prøv på nytt (Ingen verdier hentet via GET)');

?>

         </div>
      </div>
   </div>
</div>
<?php
include 'slutt.php';
?>

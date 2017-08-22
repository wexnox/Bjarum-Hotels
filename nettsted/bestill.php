<?php
include 'start.php';
include 'nav.php';
?>
<div class="container">

   <?php
         @$hotell=$_POST["hotell"];
         @$fra=$_POST["fra"];
         @$til=$_POST["til"];
         @$romtype=$_POST["romtype"];
         @$sok=$_POST["go"];

         if ($sok) {
         	if ($fra > $til) {
         		print('Ulovlig tidsperiode.');
         	} else if (!$fra || !$til || !$hotell || !$romtype) {
         		print('Vennligst fyll ut alle felter.');
         	} else {
             include("db-tilkobling.php");
             $sqlset="SELECT DISTINCT r.id, r.nr, r.rnavn, h.navn, h.city, h.land, b.filnavn
              FROM rom r
         			JOIN hotell h ON r.hotell_id = h.id
         			JOIN rom_type rt ON r.rom_type_id = rt.id
              LEFT JOIN bilde b ON b.rom_id = r.id
         			WHERE rt.id = $romtype AND
              h.id = $hotell AND
              r.id NOT IN (SELECT res.rom_id FROM reservasjon res WHERE '$fra' < utdato AND '$til' > inndato)";
              $sqlresultat=mysqli_query($db,$sqlset) or die ("Ikke mulig å hente fra database.");
          		$antrad=mysqli_num_rows($sqlresultat);

              if ($antrad == 0) {
          			print('Ingen ledige rom for denne tidsperioden.');
          		} else {

                print("<h2>Følgende rom er ledig fra $fra til $til:</h2>");
                print("<hr>");


          		for ($r=1;$r<=$antrad;$r++) {
					$rad=mysqli_fetch_array($sqlresultat);
          			$rid=$rad['id'];
          			$rnr=$rad['nr'];
          			$rnavn=$rad['rnavn'];
          			$hnavn=$rad['navn'];
          			$hby=$rad['city'];
          			$hland=$rad['land'];
					$filnavn=$rad['filnavn'];

					print("<div class='row'>");
					print("<div class='col-md-5'>");
					print("<img class='img-responsive' src='https://home.hbv.no/phptemp/web-is-gr10w/$filnavn'>");
					print("</div>");
					print("<div class='col-md-5'>");
					print("<h3>$hnavn i $hby, $hland</h3>");
					print("<h4>Romnavn: $rnavn</h4>");
					print("<p>Rom nr: $rnr</p>");
					print("<a class='btn btn-default' href='reserver.php?rid=$rid&f=$fra&t=$til'>Reserver</a>");
					print('<br><br>');
					print("<a class='btn btn-default' href='index.php'>Tilbake</a>");
					print("</div>");
					print("</div>");
					print("<hr>");
				  
          }
        }
      }
    }
         ?>
       </div>


</div>


<?php
include 'slutt.php';
?>

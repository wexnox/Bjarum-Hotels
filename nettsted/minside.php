<?php $url = 'https://home.usn.no/web-is-gr10w/nettsted'; ?>
<?php
include 'start.php';
include 'nav.php';
?>
<div class="container">
    <br>
    <h3>Min Side</h3>
    <a href="index.php" class="badge">Reserver rom</a>
    <a href="checkinn.php" class="badge">Check-in</a>
    <div class="container">

        <form method="POST" name="sok" id="sok" action="" >

            <table class="table">

                <tr>
                    <td>Reservasjons ID:</td>
                    <td>
                        <label for="refnr">
                            <input type="text" name="refid" id="refid" class="form-control">
                        </label>
                    </td>
                <tr>

                    <td>Referansenummer:</td>
                    <td>
                        <label for="refkey">
                            <input type="text" name="refkey" id="refkey" class="form-control">
                        </label>
                    </td>
                <tr>
                    <td>
                        <input type="submit" id="go" name="go" value="Søk">
                    </td>
                    <td>
                        <input type="reset" id="null" name="null" value="Nullstill">
                    </td>
                </tr>
            </table>

        </form>


        <?php

        @$refnr=$_POST["refid"];
        @$refkey=$_POST["refkey"];
        @$sok=$_POST["go"];

        if ($sok) {

          include("db-tilkobling.php");
      	$sqlset = "SELECT h.navn, r.nr, res.fornavn,
      				res.etternavn, res.inndato, res.utdato
      				FROM reservasjon res
      				JOIN rom r on res.rom_id = r.id
      				JOIN hotell h ON r.hotell_id = h.id
      			WHERE res.id = '$refnr'
      			AND res.refkey = '$refkey';";

        	$sqlresultat=mysqli_query($db,$sqlset) or die ("Ikke mulig å hente fra database");
          $antrad=mysqli_num_rows($sqlresultat);

          if (mysqli_num_rows($sqlresultat)==0) { print ("Fant ingen reservasjoner for valgt reservasjonsnummer og referansenøkkel!"); }

          for ($r=1;$r<=$antrad;$r++) {
        	$rad=mysqli_fetch_array($sqlresultat);
        	$hnavn=$rad['navn'];
        	$rnr=$rad['nr'];
        	 $resfornavn= $rad['fornavn'];
        	 $resetternavn= $rad['etternavn'];
        	 $resinndato= $rad['inndato'];
        	 $resutdato = $rad['utdato'];

           print(" <br>Følgende reservasjoner er gjort med <b>reservasjonsID:</b> $refnr og <b>referansenummer:</b> $refkey<br>
           	 <br> <b>Hotell Navn:</b> $hnavn <b>Romnr:</b> $rnr
           	<b>Fornavn:</b> $resfornavn <b> Etternavn</b> $resetternavn <b> Inndato</b> $resinndato <b> utdato</b> $resutdato");

			 print ("<br><br> <a href='minside.php?refnr=$refnr&refkey=$refkey'>Slett reservasjon</a> ");
           		 print ("<br><br> <a href='endre-res.php?refnr=$refnr&refkey=$refkey'>Endre reservasjon</a> ");

            }
		    


        }
        ?>


        <?php

        @$refnr=$_GET['refnr'];
        @$refkey=$_GET['refkey'];

        if ($refnr == true)
        {
            print ("Du har slettet reservasjonen din.");
        }

        include('db-tilkobling.php');
        $sqlsett="DELETE FROM reservasjon WHERE reservasjon.id = '$refnr' AND reservasjon.refkey = '$refkey';";
        $sqlres=mysqli_query($db,$sqlsett);

        ?>
    </div>
</div>
<?php
include 'slutt.php';
?>

<?php
include 'start.php';
include 'nav.php';
?>

<div class="container">
    <br>
    <h3>Sjekk Inn</h3>
    <a href="minside.php" class="badge">Min Side</a>
    <a href="index.php" class="badge">Reserver rom</a>
    <div class="container">
        <form method="POST" name="sok" id="sok" action="">
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
            $sqlset="SELECT h.navn, r.nr, res.fornavn,
				res.etternavn, res.inndato, res.utdato, o_r.check_in
				FROM opptatt_rom o_r
				JOIN reservasjon res ON o_r.reservasjons_id = res.id
				JOIN rom r ON res.rom_id = r.id
				JOIN hotell h ON r.hotell_id = h.id
				WHERE o_r.reservasjons_id = '$refnr'
				AND res.refkey = '$refkey'";
            $sqlresultat=mysqli_query($db,$sqlset) or die ("Ikke mulig å hente fra database");
            $antrad=mysqli_num_rows($sqlresultat);

            if ($antrad == 0) {

                $sqlset = "SELECT h.navn, r.nr, res.fornavn, res.etternavn, res.inndato, res.utdato
				FROM reservasjon res
				JOIN rom r on res.rom_id = r.id
				JOIN hotell h ON r.hotell_id = h.id
				WHERE res.id = '$refnr'
				AND res.refkey = '$refkey';";

                $sqlresultat=mysqli_query($db,$sqlset) or die ("Ikke mulig å hente fra database");
                $antrad=mysqli_num_rows($sqlresultat);

                if ($antrad==0) { print ("Fant ingen reservasjoner for valgt reservasjonsnummer og referansenøkkel!"); }


                for ($r=1;$r<=$antrad;$r++) {
                    $rad=mysqli_fetch_array($sqlresultat);
                    $hnavn=$rad['navn'];
                    $rnr=$rad['nr'];
                    $resfornavn= $rad['fornavn'];
                    $resetternavn= $rad['etternavn'];
                    $resinndato= $rad['inndato'];
                    $resutdato = $rad['utdato'];

                    print(" Følgende reservasjoner er gjort med <b>reservasjonsID:</b> $refnr og <b>referansenummer:</b> $refkey
			<br> <b>Hotell Navn:</b> $hnavn <b>Romnr:</b> $rnr
			<b>Fornavn:</b> $resfornavn <b> Etternavn</b> $resetternavn <b> Inndato</b> $resinndato <b> utdato</b> $resutdato");
                    print ("<br><br> <a href='checkk.php?refnr=$refnr&or=0'>Sjekk Inn</a> ");
                }
            } else {
                // Utsjekking
                for ($r=1;$r<=$antrad;$r++) {
                    $rad=mysqli_fetch_array($sqlresultat);
                    $hnavn=$rad['navn'];
                    $rnr=$rad['nr'];
                    $resfornavn= $rad['fornavn'];
                    $resetternavn= $rad['etternavn'];
                    $resinndato= $rad['inndato'];
                    $resutdato = $rad['utdato'];
                    $checkin = $rad['check_in'];

                    print(" Følgende reservasjoner er gjort med <b>reservasjonsID:</b> $refnr og <b>referansenummer:</b> $refkey
			<br> <b>Hotell Navn:</b> $hnavn <b>Romnr:</b> $rnr
			<b>Fornavn:</b> $resfornavn <b> Etternavn</b> $resetternavn <b> Inndato</b> $resinndato <b> utdato</b> $resutdato<br>Du sjekket inn: $checkin");
                    print ("<br><br> <a href='checkk.php?refnr=$refnr&or=1'>Sjekk ut</a> ");
                }
            }
        }
        ?>
    </div>
</div>
<?php
include 'slutt.php';
?>

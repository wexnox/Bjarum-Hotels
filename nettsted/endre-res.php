<?php
include 'start.php';
include 'nav.php';
?>
<div class="container">
    <h2>Endre din reservasjon </h2>
    <form method="POST" name="sok" id="sok" action="">

        <div class="row">
            <div class="col-sm-2">
                <h4>Fra dato</h4>
                <label for="fra">
                    <input class="datepicker" type="text" id="fra" name="fra" required />
                </label>
            </div>

            <div class="col-sm-2">
                <h4>Til dato</h4>
                <label for="til">
                    <input class="datepicker" type="text" id="til" name="til" required />
                </label>
            </div>
        </div>
        <input type="submit" id="endre" name="endre" value="Endre">
        <input type="reset" id="null" name="null" value="Nullstill">

    </form>

    <?php
    @$NyFraDato=$_POST["fra"];
    @$NyTilDato=$_POST["til"];
    @$endre=$_POST["endre"];
    @$refnr=$_GET['refnr'];
    @$refkey=$_GET['refkey'];


    if($endre){

        include("db-tilkobling.php");
        $sqlset="SELECT DISTINCT r.id, r.nr, r.rnavn, h.navn, h.city, h.land FROM rom r
			JOIN hotell h ON r.hotell_id = h.id
			JOIN reservasjon res ON r.id = res.rom_id
			JOIN rom_type rt ON r.rom_type_id = rt.id
			WHERE r.id NOT IN (SELECT rom_id from reservasjon WHERE ('$NyFraDato' BETWEEN inndato AND utdato) OR (inndato BETWEEN '$NyFraDato' AND '$NyTilDato') OR '$NyFraDato' = inndato)
			LIMIT 1;";
        $sqlresultat=mysqli_query($db,$sqlset) or die ("Ikke mulig å hente fra database");
        $antrad=mysqli_num_rows($sqlresultat);

        for ($r=1;$r<=$antrad;$r++) {
            $rad=mysqli_fetch_array($sqlresultat);
            $rid=$rad['id'];
            $rnr=$rad['nr'];
            $rnavn=$rad['rnavn'];
            $hnavn=$rad['navn'];
            $hby=$rad['city'];
            $hland=$rad['land'];

            $sqlupdate="UPDATE reservasjon
		SET inndato = '$NyFraDato', utdato = '$NyTilDato', rom_id = '$rid'
		WHERE id = '$refnr' AND refkey = '$refkey';";

            if(mysqli_query($db,$sqlupdate)){
                echo("Din reservasjon er nå endret. Ny informasjon er $NyFraDato til $NyTilDato på $hnavn rom $rnr");
            }else{
                echo("Din endring kunne ikke bli fulført grunnet fullbooking");
            }

        }
    }
    ?>
</div>
<?php include 'slutt.php'; ?>

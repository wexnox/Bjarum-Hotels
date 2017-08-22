<?php
include 'start.php';
include 'nav.php';
// TODO: denne må ordnes
$link=mysqli_connect("localhost","root","secret","bjarumairline");
mysqli_select_db($link,"web-is-gr10w");
?>

<div class="container">

    <h2 class="text-center">Rom</h2>

    <?php
    $res=mysqli_query($link,"select b.filnavn, rt.beskrivelse, r.rnavn, h.navn from rom r
                             join rom_type rt on r.rom_type_id = rt.id
                             right join bilde b on b.rom_id = r.id
							 join hotell h on r.hotell_id=h.id");

    while($row=mysqli_fetch_array($res))
    {
        ?>
        <div class="col-sm-4 wowload fadeInUp">
            <div class="rooms">
                <img src="https://home.hbv.no/phptemp/web-is-gr10w/<?php echo $row["filnavn"]; ?>" class="img-responsive" style="width: 500px; height:270px";>
                <div class="info">
                    <h3><?php echo $row["beskrivelse"]; ?></h3>
                    <p><?php echo $row["rnavn"]; ?> </p>
                    <p><?php echo $row["navn"]; ?> </p>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
</div>
<?php include 'slutt.php';?>

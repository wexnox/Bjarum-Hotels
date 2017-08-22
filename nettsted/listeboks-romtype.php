<?php
include("db-tilkobling.php");

$sqlsetning="SELECT * FROM rom_type ORDER BY id;";
$sqlresultat=mysqli_query($db,$sqlsetning) or die ("Ikke mulig å hente fra database");

$antallrader=mysqli_num_rows($sqlresultat);

for ($r=1;$r<=$antallrader;$r++)
{
    $rad=mysqli_fetch_array($sqlresultat);
    $id=$rad["id"];
    $besk=$rad["beskrivelse"];
    $maxgjest=$rad["max_gjester"];

    print("<option value='$id'>$besk for $maxgjest person(er)</option>");
}
?>
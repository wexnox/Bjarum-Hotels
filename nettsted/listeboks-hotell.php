<?php
include("db-tilkobling.php");

$sqlsetning="SELECT * FROM hotell ORDER BY navn;";
$sqlresultat=mysqli_query($db,$sqlsetning) or die ("Ikke mulig å hente fra database");

$antallrader=mysqli_num_rows($sqlresultat);

for ($r=1;$r<=$antallrader;$r++)
{
    $rad=mysqli_fetch_array($sqlresultat);
    $id=$rad["id"];
    $navn=$rad["navn"];
    $by=$rad["city"];
    $land=$rad["land"];

    print("<option value='$id'>$navn: $by, $land</option>");
}
?>
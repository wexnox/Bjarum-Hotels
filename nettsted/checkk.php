<?php
include 'start.php';
include 'nav.php';
?>
<?php

@$getrefnr=$_GET['refnr'];
@$getor=$_GET['or'];
include('db-tilkobling.php');
if ($getrefnr) {
    if ($getor == '1') {
        $sqlset="UPDATE opptatt_rom SET check_out = CURRENT_TIMESTAMP WHERE reservasjons_id = $getrefnr";
        $sqlres=mysqli_query($db,$sqlset);
        print ("Du har nå sjekket ut. Gå <a href='checkinn.php'>tilbake</a>");
    }

    if ($getor == '0') {
        $sqlset="INSERT INTO opptatt_rom (check_in, reservasjons_id) VALUES (CURRENT_TIMESTAMP, $getrefnr)";
        $sqlres=mysqli_query($db,$sqlset);
        print ("Du har nå sjekket inn. Gå <a href='checkinn.php'>tilbake</a>");
    }
}

?>

<?php
include 'slutt.php';
?>

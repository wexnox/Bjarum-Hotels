<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 11.49
 */


require_once("../session.php");
include '../header.php';
include '../nav.php';
// Gets the database connection
$database = new Database();
$db = $database->dbConnection();
// pass the connection to objects
$bilde = new Bilde();
?>
    <div class='clearfix'></div>
    <div class='container-fluid' style='margin-top:80px;'>
        <div class="container">
            <H1>Bilde CRUD</H1>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="container">
        <a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
    </div>
    <div class="clearfix"></div><br />
    <div class="container">
        <table class='table table-bordered table-responsive'>
            <tr>
                <th>ID</th>
                <th>Filnavn</th> <!-- TODO: Her skulle/burde det vært thumbnails på bildene -->
                <th>Rom Nr</th>
                <th>Rom Navn</th>
                <th colspan="2" align="center">Actions</th>
            </tr>
            <?php
            $query = "SELECT b.id, b.filnavn, r.nr, r.rnavn FROM bilde b RIGHT JOIN rom r ON b.rom_id = r.id WHERE b.id";
            $records_per_page=10;
            $newquery = $bilde->paging($query,$records_per_page);
            $bilde->dataview($newquery);
            ?>
            <tr>
                <td colspan="8" align="center">
                    <div class="pagination-wrap">
                        <?php $bilde->paginglink($query,$records_per_page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<?php
include '../footer.php';
?>
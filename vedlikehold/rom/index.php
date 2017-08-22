<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 09.15
 */

require_once("../session.php");
include '../header.php';
include '../nav.php';
// Gets the database connection
$database = new Database();
$db = $database->dbConnection();
// pass the connection to objects
$rom = new Rom();
?>
    <div class='clearfix'></div>
    <div class='container-fluid' style='margin-top:80px;'>
        <div class="container">
            <H1>Rom CRUD</H1>
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
                <th>Id</th>
                <th>Rom Nr</th>
                <th>Rom Navn</th>
                <th>Rom Tilstand</th>
                <th>Rom Beskrivelse</th>
                <th>Max Gjester</th>
                <th>Hotell Navn</th>
                <th>By</th>
                <th>Land</th>
                <th colspan="2" align="center">Actions</th>
            </tr>
            <?php
            $query = "SELECT r.id, r.nr, r.rnavn, r.tilstand, rt.beskrivelse, rt.max_gjester, ht.navn, ht.city, ht.land 
                      FROM rom r 
                      LEFT JOIN rom_type rt ON r.rom_type_id = rt.id
                      LEFT JOIN hotell ht ON r.hotell_id = ht.id WHERE r.id";
            $records_per_page=10;
            $newquery = $rom->paging($query,$records_per_page);
            $rom->dataview($newquery);
            ?>
            <tr>
                <td colspan="11" align="center">
                    <div class="pagination-wrap">
                        <?php $rom->paginglink($query,$records_per_page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<?php
include '../footer.php';
?>
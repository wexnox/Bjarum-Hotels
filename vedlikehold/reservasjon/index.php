<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 17.01.2017
 * Time: 20.23
 */
require_once("../session.php");
include '../header.php';
include '../nav.php';
// Gets the database connection
$database = new Database();
$db = $database->dbConnection();
// pass the connection to objects
$reservasjon = new Reservasjon();
?>
    <div class='clearfix'></div>

    <div class='container-fluid' style='margin-top:80px;'>

        <div class="container">

            <H1>Reservasjon CRUD</H1>

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
                <th>Inndato</th>
                <th>Utdato</th>
                <th>Rom ID</th>
                <th>Rom Navn</th>
                <th>Fornavn</th>
                <th>Etternavn</th>
                <th>Refkey</th>
                <th colspan="2" align="center">Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM reservasjon JOIN rom r ON reservasjon.rom_id = r.id";
            $records_per_page=10;
            $newquery = $reservasjon->paging($query,$records_per_page);
            $reservasjon->dataview($newquery);
            ?>
            <tr>
                <td colspan="10" align="center">
                    <div class="pagination-wrap">
                        <?php $reservasjon->paginglink($query,$records_per_page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<?php
include '../footer.php';
?>
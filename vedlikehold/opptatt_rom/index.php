<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 22.01.2017
 * Time: 20.54
 */
require_once("../session.php");
include '../header.php';
include '../nav.php';
// Gets the database connection
$database = new Database();
$db = $database->dbConnection();
// pass the connection to objects
$opptatt_rom = new Opptatt_rom();
?>
    <div class='clearfix'></div>

    <div class='container-fluid' style='margin-top:80px;'>

        <div class="container">

            <H1>Opptatt Rom CRUD</H1>

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
                <th>Check In</th>
                <th>Check Out</th>
                <th>Reservasjons ID</th>
                <th colspan="2" align="center">Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM opptatt_rom";
            $records_per_page=10;
            $newquery = $opptatt_rom->paging($query,$records_per_page);
            $opptatt_rom->dataview($newquery);
            ?>
            <tr>
                <td colspan="8" align="center">
                    <div class="pagination-wrap">
                        <?php $opptatt_rom->paginglink($query,$records_per_page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<?php
include '../footer.php';
?>
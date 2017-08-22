<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 08.01.2017
 * Time: 10.37
 */
require_once("../session.php");
include '../header.php';
include '../nav.php';
// Gets the database connection
$database = new Database();
$db = $database->dbConnection();
// pass the connection to objects
$rom_type = new Rom_type();
?>
    <div class='clearfix'></div>

    <div class='container-fluid' style='margin-top:80px;'>

        <div class="container">

            <H1>Rom Type CRUD</H1>

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
                <th>Rom Beskrivelse</th>
                <th>Max Gjester</th>
                <th colspan="2" align="center">Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM rom_type";
            $records_per_page=10;
            $newquery = $rom_type->paging($query,$records_per_page);
            $rom_type->dataview($newquery);
            ?>
            <tr>
                <td colspan="8" align="center">
                    <div class="pagination-wrap">
                        <?php $rom_type->paginglink($query,$records_per_page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<?php
include '../footer.php';
?>
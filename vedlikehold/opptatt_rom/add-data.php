<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 22.01.2017
 * Time: 21.41
 */
require_once("../session.php");

$database = new Database();
$db = $database->dbConnection();
$opptatt_rom = new Opptatt_rom();

if(isset($_POST['btn-save']))
{
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $reservasjons_id = $_POST['reservasjons_id'];

    if($opptatt_rom->create($check_in,$check_out, $reservasjons_id))
    {
        header("Location: add-data.php?inserted");
    }
    else
    {
        header("Location: add-data.php?failure");
    }
}
?>
<?php
include '../header.php';
include '../nav.php';
?>
    <div class="clearfix"></div>
    <div class="container-fluid" style="margin-top:80px;">

<?php
if(isset($_GET['inserted']))
{
    ?>
    <div class="container">
        <div class="alert alert-info">
            <strong>WOW!</strong> Record was inserted successfully <a href="index.php">HOME</a>!
        </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>SORRY!</strong> ERROR while inserting record !
        </div>
    </div>
    <?php
}
?>
    <div class="clearfix"></div>
    <div class="container-fluid">
        <div class="container">
            <H1>Legg til data</H1>
        </div>
    </div>
    <div class="clearfix"></div><br />
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form method='post'>
                        <table class='table table-bordered'>
                            <tr>
                                <td>Check In</td>
                                <td>
                                    <label for="check_in">
                                        <input type='text' id="check_in" name='check_in' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Check Out</td>
                                <td>
                                    <label for="check_out">
                                        <input type='text' id="check_out" name='check_out' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Reservasjons_id</td>
                                <td>
                                    <label for="reservasjons_id">
                                        <input type="text" id="reservasjons_id" name="reservasjons_id" class="form-control" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-primary" name="btn-save">
                                        <span class="glyphicon glyphicon-plus"></span> Create New Record
                                    </button>
                                    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
include '../footer.php';
?>
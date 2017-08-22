<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 24.01.2017
 * Time: 08.22
 */
require_once("../session.php");
$database = new Database();
$db = $database->dbConnection();
$opptatt_rom = new Opptatt_rom();


if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $reservasjons_id = $_POST['reservasjons_id'];



    if (empty($check_in || $check_out || $reservasjons_id)){
        $msg ="<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR while updating  !</div></div>";
    }

    if($opptatt_rom->update($id, $check_in, $check_out, $reservasjons_id))
    {
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-info'>
                <strong>WOW!</strong> Record was updated successfully 
                <a href='sok.php'>HOME</a>!</div></div>";
    }
    else
    {
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR while updating record !</div></div>";
    }
}
if(isset($_GET['edit_id']))
{
    $id = $_GET['edit_id'];
    extract($opptatt_rom->getID($id));
}
?>
<?php
include '../header.php';
include '../nav.php'; ?>

    <div class="clearfix"></div>
    <div class="container">
        <?php
        if(isset($msg))
        {
            echo $msg;
        }
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="container-fluid" style="margin-top:80px;">
        <div class="container">
            <H1>Rediger data</H1>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form method='post' >
                        <table class='table table-bordered'>
                            <tr>
                                <td>Check In</td>
                                <td>
                                    <label for="check_in">
                                        <input type='text' id="check_in" name='check_in' class='form-control' value="<?php echo $check_in; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Check Out</td>
                                <td>
                                    <label for="check_out">
                                        <input type='text' id="check_out" name='check_out' class='form-control' value="<?php echo $check_out; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Reservasjons ID</td>
                                <td>
                                    <label for="reservasjons_id">
                                        <input type='text' id="reservasjons_id" name='reservasjons_id' class='form-control' value="<?php echo $reservasjons_id; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-primary" name="btn-update">
                                        <span class="glyphicon glyphicon-edit"></span>  Update this Record
                                    </button>
                                    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
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
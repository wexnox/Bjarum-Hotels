<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 15.01.2017
 * Time: 23.32
 */
require_once("../session.php");
$database = new Database();
$db = $database->dbConnection();
$hotell = new Hotell();

if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $navn = $_POST['navn'];
    $city = $_POST['city'];
    $land =$_POST['land'];

    if (empty($navn)){
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> Dont leave name empty! 
                <a href='sok.php'>HOME</a>!</div></div>";
    }
    if (empty($city)){
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> Dont leave City empty! 
                <a href='sok.php'>HOME</a>!</div></div>";
    }
    if (empty($land)){
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> Dont leave Country empty! 
                <a href='sok.php'>HOME</a>!</div></div>";
    }

    if($hotell->update($id, $navn, $city, $land))
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
    extract($hotell->getID($id));
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
                                <td>Hotell Navn</td>
                                <td>
                                    <label for="navn">
                                        <input type='text' id="navn" name='navn' class='form-control' value="<?php echo $navn; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>By</td>
                                <td>
                                    <label for="city">
                                        <input type='text' id="city" name='city' class='form-control' value="<?php echo $city; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Land</td>
                                <td>
                                    <label for="land">
                                        <input type='text' id="land" name='land' class='form-control' value="<?php echo $land; ?>" required>
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
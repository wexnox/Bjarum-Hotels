<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 15.01.2017
 * Time: 23.24
 */
require_once("../session.php");

$database = new Database();
$db = $database->dbConnection();
$hotell = new Hotell();

if(isset($_POST['btn-save'])) {
    $navn = $_POST['navn'];
    $city = $_POST['city'];
    $land =$_POST['land'];
    // TODO: Lage egen failure reply on error
    if (empty($navn)){

        header("Location: add-data.php?failure");
        return false;
    }
    if (empty($city)){
        header("Location: add-data.php?failure");
        return false;
    }
    if (empty($land)){
        header("Location: add-data.php?failure");
        return false;
    }

    if($hotell->create($navn, $city, $land)) {
        header("Location: add-data.php?inserted");
    } else {
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
if(isset($_GET['inserted'])){
    ?>
    <div class="container">
        <div class="alert alert-info">
            <strong>WOW!</strong> Record was inserted successfully <a href="index.php">HOME</a>!
        </div>
    </div>
    <?php
}else if(isset($_GET['failure'])){
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>SORRY!</strong> ERROR while inserting record !
        </div>
    </div>
    <?php
}
?>
    <!--TODO: Legge til placeholders perhaps-->
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
                                <td>Hotell Navn</td>
                                <td>
                                    <label for="navn">
                                        <input type='text' id="navn" name='navn' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>By</td>
                                <td>
                                    <label for="city">
                                        <input type='text' id="city" name='city' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Land</td>
                                <td>
                                    <label for="land">
                                        <input type="text" id="land" name="land" class="form-control" required>
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
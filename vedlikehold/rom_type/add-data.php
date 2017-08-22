<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 14.01.2017
 * Time: 13.08
 * Ser ikke behovet for en dropdown/listebox her med antall tillatte gjester, bare mer å trykke på :(
 */
require_once("../session.php");

$database = new Database();
$db = $database->dbConnection();
$rom_type = new Rom_type();

if(isset($_POST['btn-save']))
{
    $beskrivelse = $_POST['beskrivelse'];
    $max_gjester = $_POST['max_gjester'];

    if (empty($beskrivelse || $max_gjester)){
        header("Location: add-data.php?failure");
    }

    if (is_numeric($beskrivelse)){
        header("Location: add-data.php?failure");
    }

    if (!is_numeric($max_gjester)){

    }

    if($rom_type->create($beskrivelse,$max_gjester))
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
                                <td>Rom Beskrivelse</td>
                                <td>
                                    <label for="beskrivelse">
                                        <input type='text' id="beskrivelse" name='beskrivelse' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Max Gjester</td>
                                <td>
                                    <label for="max_gjester">
                                        <select name="max_gjester" id="max_gjester" class="form-control">
                                            <?php for ($i = 1; $i <= 200; $i++) : ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
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
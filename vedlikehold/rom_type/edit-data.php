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

if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $beskrivelse = $_POST['beskrivelse'];
    $max_gjester = $_POST['max_gjester'];

    if (empty($beskrivelse)){
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> Please add a description</div></div>";
    }
    if (empty($max_gjester)){
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> Please add max allotted guest</div></div>";
    }


    if($rom_type->update($id,$beskrivelse,$max_gjester))
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
    extract($rom_type->getID($id));
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
                                <td>Rom Beskrivelse</td>
                                <td>
                                    <label for="beskrivelse">
                                        <input type='text' id="beskrivelse" name='beskrivelse' class='form-control' value="<?php echo $beskrivelse; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Max Gjester</td>
                                <td>
                                    <?php
                                    $sql = $db->prepare("SELECT * FROM rom_type WHERE id=:id");
                                    $sql->bindParam(":id", $id);
                                    $sql->execute();
                                    $resultat=$sql->fetch();
                                    ?>
                                    <label for="max_gjester">
                                        <select name="max_gjester" id="max_gjester">
                                            <option value="<?php echo ($resultat['id']); ?>"><?php echo ($resultat['max_gjester']); ?></option>
                                            <?php for ($i = 1; $i <= 200; $i++) : ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
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
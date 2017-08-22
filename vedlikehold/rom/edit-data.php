<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 12.01.2017
 * Time: 13.55
 */

require_once("../session.php");
$database = new Database();
$db = $database->dbConnection();
$rom = new Rom();

if(isset($_POST['btn-update'])) {
    $id = $_GET['edit_id'];
    $nr = $_POST['nr'];
    $rnavn = $_POST['rnavn'];
    $tilstand = $_POST['tilstand'];
    $rom_type_id = $_POST['rom_type_id'];
    $hotell_id = $_POST['hotell_id'];



    if (empty($nr || $rnavn || $tilstand || $rom_type_id || $hotell_id)){
        $msg ="<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR while updating nr  !</div></div>";
    }

    if($rom->update($id, $nr, $rnavn, $tilstand, $rom_type_id, $hotell_id))
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
    extract($rom->getID($id));
}
?>
<?php
include '../header.php';
include '../nav.php';
?>

    <div class="clearfix"></div>
    <div class="container">
        <?php
        if(isset($msg)) {
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
                                <td>Rom nr</td>
                                <td>
                                    <label for="nr">
                                        <input type='text' id="nr" name='nr' class='form-control' value="<?php echo $nr; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom Navn</td>
                                <td>
                                    <label for="rnavn">
                                        <input type='text' id="rnavn" name='rnavn' class='form-control' value="<?php echo $rnavn; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom Tilstand</td>
                                <td>
                                    <label for="tilstand">
                                        <input type='text' id="tilstand" name='tilstand' class='form-control' value="<?php echo $tilstand; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom Type</td>
                                <td>
                                    <?php
                                    $sql = $db->prepare("SELECT * FROM rom_type WHERE id=:id");
                                    $sql->bindParam(":id", $rom_type_id);
                                    $sql->execute();
                                    $resultat=$sql->fetch();
                                    ?>
                                    <label for="rom_type_id">
                                        <select name="rom_type_id" id="rom_type_id">
                                            <option value="<?php echo ($resultat['id']); ?>"><?php echo ($resultat['beskrivelse']); ?></option>
                                            <?php // TODO: convert this to a method in class
                                            if (!empty($rom_type_id)) {

                                                try{
                                                    $sql = "SELECT * FROM rom_type";
                                                    $stmt = $db->query($sql);
                                                    $rom_type = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                } catch (PDOException $e){
                                                    echo ("<div class='clearfix'></div><div class='container-fluid' style='margin-top:80px;'>'");
                                                    echo $e->getMessage();
                                                    return false;
                                                } ?>
                                                <?php foreach($rom_type as $row) {?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['beskrivelse']; ?></option>
                                                <?php } ?>
                                            <?php } ?>

                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Hotell</td>
                                <td>
                                    <?php
                                    $sql = $db->prepare("SELECT * FROM hotell WHERE id=:id");
                                    $sql->bindParam(":id",$hotell_id);
                                    $sql->execute();
                                    $resultat=$sql->fetch();
                                    //print_r($resultat);
                                    ?>
                                    <label for="hotell_id">
                                        <select name="hotell_id" id="hotell_id" >
                                            <option value="<?php echo ($resultat['id']); ?>"><?php echo ($resultat['navn']); ?></option>
                                            <?php if (!empty($hotell_id)) {
                                                try{
                                                    $sql = "SELECT * FROM hotell";
                                                    $stmt = $db->query($sql);
                                                    $hotell = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                } catch (PDOException $e){
                                                    echo ("<div class='clearfix'></div><div class='container-fluid' style='margin-top:80px;'>'");
                                                    echo $e->getMessage();
                                                    return false;
                                                }
                                                ?>
                                                <?php foreach($hotell as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['navn']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
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
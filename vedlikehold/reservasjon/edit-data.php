<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 24.01.2017
 * Time: 09.05
 */
require_once("../session.php");
$database = new Database();
$db = $database->dbConnection();
$reservasjon = new Reservasjon();


if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $inndato = $_POST['inndato'];
    $utdato = $_POST['utdato'];
    $rom_id = $_POST['rom_id'];
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $refkey = $_POST['refkey'];



    if (empty($inndato || $utdato || $rom_id || $fornavn || $etternavn || $refkey)){
        $msg ="<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR while updating  !</div></div>";
    }

    if($reservasjon->update($id, $inndato, $utdato, $rom_id, $fornavn, $etternavn, $refkey))
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
    extract($reservasjon->getID($id));
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
                                <td>Check In Dato</td>
                                <td>
                                    <label for="inndato">
                                        <input type='text' id="inndato" name='inndato' class='form-control' value="<?php echo $inndato; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Check Out Dato</td>
                                <td>
                                    <label for="utdato">
                                        <input type='text' id="utdato" name='utdato' class='form-control' value="<?php echo $utdato; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom ID</td>
                                <td>
                                    <?php
                                    $sql = $db->prepare("SELECT * FROM rom WHERE id=:id");
                                    $sql->bindParam(":id", $rom_id);
                                    $sql->execute();
                                    $resultat=$sql->fetch();
                                    ?>
                                    <label for="rom_id">
                                        <select name="rom_id" id="rom_id">
                                            <option value="<?php echo ($resultat['id']); ?>"><?php echo ($resultat['rnavn']); ?></option>
                                            <?php // TODO: convert this to a method in class
                                            if (!empty($rom_id)) {

                                                try{
                                                    $sql = "SELECT * FROM rom";
                                                    $stmt = $db->query($sql);
                                                    $rom = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                } catch (PDOException $e){
                                                    echo ("<div class='clearfix'></div><div class='container-fluid' style='margin-top:80px;'>'");
                                                    echo $e->getMessage();
                                                    return false;
                                                } ?>
                                                <?php

                                                foreach($rom as $row) {?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['rnavn']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Fornavn</td>
                                <td>
                                    <label for="fornavn">
                                        <input type="text" id="fornavn" name="fornavn" class="form-control" value="<?php echo $fornavn; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Etternavn</td>
                                <td>
                                    <label for="etternavn">
                                        <input type="text" id="etternavn" name="etternavn" class="form-control" value="<?php echo $etternavn; ?>" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Refkey</td>
                                <td>
                                    <label for="refkey">
                                        <input type="text" id="refkey" name="refkey" class="form-control" value="<?php echo $refkey; ?>" required>
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
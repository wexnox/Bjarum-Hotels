<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 12.01.2017
 * Time: 13.51
 */
require_once("../session.php");

$database = new Database();
$db = $database->dbConnection();
$rom = new Rom();

try{
    $sql = "SELECT * FROM rom_type";
    $stmt = $db->query($sql);
    $rom_type = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
    echo $e->getMessage();
    return false;
}
try{
    $sql2 = "SELECT * FROM hotell";
    $stmt2 = $db->query($sql2);
    $hotell = $stmt2->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
    echo $e->getMessage();
    return false;
}

if(isset($_POST['btn-save'])) {
    $nr = $_POST['nr'];
    $rnavn = $_POST['rnavn'];
    $tilstand = $_POST['tilstand'];
    $rom_type_id = $_POST['rom_type_id'];
    $hotell_id = $_POST['hotell_id'];

    if (!is_numeric($nr)){
        header("Location: add-data.php?failure");
    }

    if(empty($rnavn || $tilstand || $rom_type_id || $hotell_id)){
        header("Location: add-data.php?failure");
    }

    if($rom->create($nr,$rnavn,$tilstand,$rom_type_id,$hotell_id)) {
        header("Location: add-data.php?inserted");
    }
    else{
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
                                <td>Rom NR</td>
                                <td>
                                    <label for="nr">
                                        <input type='text' id="nr" name='nr' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom Navn</td>
                                <td>
                                    <label for="rnavn">
                                        <input type='text' id="rnavn" name='rnavn' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom tilstand</td>
                                <td>
                                    <label for="tilstand">
                                        <input type='text' id="tilstand" name='tilstand' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom Type</td>
                                <td>
                                    <label for="rom type_id">
                                        <select name="rom_type_id" id="rom_type_id">
                                            <option value="">--Velg--</option>
                                            <?php if (!empty($rom_type)) { ?>
                                                <?php foreach($rom_type as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['beskrivelse']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Hotell ID</td>
                                <td>
                                    <label for="hotell_id">
                                        <select name="hotell_id" id="hotell_id">
                                            <option value="">--Velg--</option>
                                            <?php if (!empty($hotell)) { ?>
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
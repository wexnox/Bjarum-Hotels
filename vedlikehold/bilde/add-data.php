<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 16.01.2017
 * Time: 14.30
 */
require_once("../session.php");
error_reporting( ~E_NOTICE );

$database = new Database();
$db = $database->dbConnection();
$bilde = new Bilde();

//dropdown rom
//TODO: gjøre om til en funksjon
try {
    $sql= "SELECT * FROM rom";
    $stmt = $db->query($sql);
    $rom_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
    return false;
}

if(isset($_POST['btn-save'])) {
    // Trengs til upload
    $imgFile = $_FILES['rom_image']['name'];
    $tmp_dir = $_FILES['rom_image']['tmp_name'];
    $imgSize = $_FILES['rom_image']['size'];
    // tilhørighet
    $rom_id = $_POST['rom_id'];

    if (empty($rom_id)){
        echo('Fyll ut rom'); // TODO: Styling
        return false;
    }

    if($bilde->create($imgFile, $imgSize, $tmp_dir, $rom_id)) {
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
            <H1>Legg til bilde</H1>
        </div>
    </div>
    <div class="clearfix"></div><br />
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form method='post' enctype="multipart/form-data" class="form-horizontal update">
                        <table class='table table-bordered'>
                            <tr>
                                <td>Rom</td>
                                <td>
                                    <label for="rom id">
                                        <select name="rom_id" id="rom_id" class="update">
                                            <option value="">----</option>
                                            <?php if (!empty($rom_id)) { ?>
                                                <?php foreach($rom_id as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['rnavn']." ".$row['nr']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom Bilde</td>
                                <td>
                                    <label for="filnavn">
                                        <input type='file' id="rom_image" name='rom_image' class='input-group form-control' >
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
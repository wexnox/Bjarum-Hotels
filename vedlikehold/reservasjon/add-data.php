<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 24.01.2017
 * Time: 08.57
 */
require_once("../session.php");

$database = new Database();
$db = $database->dbConnection();
$reservasjon = new Reservasjon();

try{
    $sql = "SELECT * FROM rom ";
    $stmt = $db->query($sql);
    $rom = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e){
    echo $e->getMessage();
}


if(isset($_POST['btn-save']))
{
    $inndato = $_POST['inndato'];
    $utdato = $_POST['utdato'];
    $rom_id = $_POST['rom_id'];
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $refkey = $_POST['refkey'];

    if($reservasjon->create($inndato, $utdato, $rom_id, $fornavn, $etternavn, $refkey))
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
                                <td>Inndato</td>
                                <td>
                                    <label for="inndato">
                                        <input type='text' id="inndato" name='inndato' class='form-control' required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Utdato</td>
                                <td>
                                    <label for="utdato">
                                        <input type='text' id="utdato" name='utdato' class='form-control' required>
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <td>Fornavn</td>
                                <td>
                                    <label for="fornavn">
                                        <input type="text" id="fornavn" name="fornavn" class="form-control" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Etternavn</td>
                                <td>
                                    <label for="etternavn">
                                        <input type="text" id="etternavn" name="etternavn" class="form-control" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Refkey</td>
                                <td>
                                    <label for="refkey">
                                        <input type="text" id="refkey" name="refkey" class="form-control" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Rom Tilhørighet</td>
                                <td>
                                    <label for="rom_id">
                                        <select name="rom_id" id="rom_id">
                                            <option value="">--Velg--</option>
                                            <?php if (!empty($rom)) {?>
                                                <?php foreach($rom as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['rnavn']; ?></option>
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
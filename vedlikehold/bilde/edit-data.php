<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 16.01.2017
 * Time: 14.37
 */

require_once("../session.php");
$database = new Database();
$db = $database->dbConnection();
$bilde = new Bilde();



if(isset($_POST['btn-update'])){
    $id = $_GET['edit_id'];
    $rom_id = $_POST['rom_id'];

    if (empty($rom_id)){
        echo('Fyll ut rom');
        return false;
    }

    if($bilde->update($id, $rom_id)){
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-info'>
                <strong>WOW!</strong> Record was updated successfully 
                <a href='sok.php'>HOME</a>!</div></div>";
    }else{
        $msg = "<div class='clearfix'></div>
                <div class='container-fluid' style='margin-top:80px;'>
                <div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR while updating record !</div></div>";
    }
}
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    extract($bilde->getID($id));

}
?>
<?php
include '../header.php';
include '../nav.php'; ?>

    <div class="clearfix"></div>
    <div class="container">
        <?php
        if(isset($msg)){
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
                                <td>Rom ID</td>
                                <td>
                                    <label for="rom id">
                                        <select name="rom_id" id="rom_id" class="form-control">
                                            <option value="">----</option>
                                            <?php if (!empty($rom_id)) {
                                                try{
                                                    //$sql= "SELECT b.rom_id, b.filnavn, r.nr, r.rnavn FROM bilde b LEFT JOIN rom r ON b.rom_id = r.id WHERE r.id";
                                                    $sql = "SELECT * FROM rom";
                                                    $stmt = $db->query($sql);
                                                    $rom = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                }catch (PDOException $e){
                                                    echo ("<div class='clearfix'></div><div class='container-fluid' style='margin-top:80px;'>'");
                                                    echo $e->getMessage();
                                                    return false;
                                                }
                                                ?>
                                                <?php foreach($rom as $row) {?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['rnavn']; ?></option>
                                                <?php } ?>
                                            <?php }?>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <?php
//                                echo '<pre>';
//                                var_dump($rom);
//                                var_dump($id);
//                                echo '</pre>';
                                ?>
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
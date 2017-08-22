<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 14.01.2017
 * Time: 13.08
 */

require_once("../session.php");
$database = new Database();
$db = $database->dbConnection();
$rom_type = new Rom_type();

if(isset($_POST['btn-del']))
{
    $id = $_GET['delete_id'];
    $rom_type->delete($id);
    header("Location: delete.php?deleted");
}

?>
<?php
include '../header.php';
include '../nav.php';
?>
    <div class="clearfix"></div>
    <div class="container-fluid" style="margin-top:80px;">
        <?php
        if(isset($_GET['deleted']))
        {
            ?>
            <div class="container">
                <div class="alert alert-success">
                    <strong>Success!</strong> record was deleted...
                </div>
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="container">
                <div class="alert alert-danger">
                    <strong>Sure !</strong> to remove the following record ?
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="container">
        <?php
        if(isset($_GET['delete_id']))
        {
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>ID</th>
                    <th>Beskrivelse</th>
                    <th>Max Gjester</th>

                </tr>
                <?php
                $stmt = $db->prepare("SELECT * FROM rom_type WHERE id=:id");
                $stmt->execute(array(":id"=>$_GET['delete_id']));
                while($row=$stmt->fetch(PDO::FETCH_BOTH))
                {
                    ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['beskrivelse']); ?></td>
                        <td><?php print($row['max_gjester']); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
        ?>
    </div>
    <div class="container">
        <p>
            <?php
            if(isset($_GET['delete_id']))
            {
            ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
        </form>
        <?php
        }
        else
        {
            ?>
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            <?php
        }
        ?>
        </p>
    </div>
<?php
include '../footer.php';
?>
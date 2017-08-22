<?php

/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 15.01.2017
 * Time: 23.36
 */
class Bilde
{
    public $conn;

    function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn=$db;
    }

    public function create($imgFile, $imgSize, $tmp_dir, $rom_id) //TODO: Denne må redigeres per table
    {

        $upload_dir = 'D:\\Sites\\home.hbv.no\\phptemp\\web-is-gr10w/'; // upload dir

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // checks the image file extention

        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // acceptable file extentions

        $romImage = rand(1000, 1000000) . "." . $imgExt; // randomize filename to reduce the chance of same filename

        if (in_array($imgExt, $valid_extensions)) {
            // Check file size '50MB'
            if ($imgSize < 50000000) {
                move_uploaded_file($tmp_dir, $upload_dir . $romImage);
                try {
                    // TODO: Denne må forandres basert på tablen
                    $stmt = $this->conn->prepare("INSERT INTO bilde (filnavn,rom_id) VALUES(:filnavn, :rom_id)");
                    $stmt->bindParam(":filnavn", $romImage);
                    $stmt->bindParam(":rom_id", $rom_id);
                    $stmt->execute();

                    return true;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }
            } else {
                die('Your file is too large.');
                // TODO: Styling
            }
        } else {
            die(' And it only accepts JPG, JPEG, PNG and GIF files');
            // TODO: Styling
        }

    }

    public function getID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM bilde WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id,$rom_id)
    {
        try {
            $stmt=$this->conn->prepare("UPDATE bilde SET rom_id=:rom_id WHERE id=:id ");
            $stmt->bindParam(":rom_id", $rom_id);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

    public function delete($id){
        $stmt_bilde = $this->conn->prepare('SELECT filnavn FROM bilde WHERE id=:id');
        $stmt_bilde->bindParam(':id',$id);
        $stmt_bilde->execute();
        $imgRow=$stmt_bilde->fetch(PDO::FETCH_ASSOC);
        unlink("D:\\Sites\\home.hbv.no\\phptemp\\web-is-gr10w/".$imgRow['filnavn']);

        $stmt = $this->conn->prepare("DELETE FROM bilde WHERE id=:id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        return true;
    }

    /* paging */

    public function dataview($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><a href='https://home.hbv.no/phptemp/web-is-gr10w/<?php print($row['filnavn']); ?>' target='_blank'><?php print($row['filnavn']); ?></a></td>
                    <td><?php print($row['nr']); ?></td>
                    <td><?php print($row['rnavn']); ?></td>

                    <td align="center">
                        <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
            <?php
        }

    }

    public function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query,$records_per_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if($total_no_of_records > 0)
        {
            ?><ul class="pagination"><?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"]))
            {
                $current_page=$_GET["page_no"];
            }
            if($current_page!=1)
            {
                $previous =$current_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for($i=1;$i<=$total_no_of_pages;$i++)
            {
                if($i==$current_page)
                {
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                }
                else
                {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages)
            {
                $next=$current_page+1;
                echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }

    /* paging */

}
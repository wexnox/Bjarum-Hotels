<?php

/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 09.14
 */

class Rom
{
    public $conn;

    function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function create($nr, $rnavn, $tilstand, $rom_type_id, $hotell_id)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO rom(nr, rnavn, tilstand, rom_type_id, hotell_id) VALUES(:nr, :rnavn, :tilstand, :rom_type_id, :hotell_id)");
            $stmt->bindParam(":nr", $nr);
            $stmt->bindParam(":rnavn", $rnavn);
            $stmt->bindParam(":tilstand", $tilstand);
            $stmt->bindParam(":rom_type_id", $rom_type_id);
            $stmt->bindParam(":hotell_id", $hotell_id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM rom WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id, $nr, $rnavn, $tilstand, $rom_type_id, $hotell_id)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE rom SET nr=:nr, rnavn=:rnavn, tilstand=:tilstand, rom_type_id=:rom_type_id, hotell_id=:hotell_id WHERE id=:id ");
            $stmt->bindParam(":nr", $nr);
            $stmt->bindParam(":rnavn", $rnavn);
            $stmt->bindParam(":tilstand", $tilstand);
            $stmt->bindParam(":rom_type_id", $rom_type_id);
            $stmt->bindParam(":hotell_id", $hotell_id);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM rom WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return true;
    }

    // TODO: fix this method to show current hotell name
//    public function getName($id)
//    {
//prepare("SELECT ht.navn FROM rom r LEFT JOIN hotell ht ON r.hotell_id = ht.id WHERE r.id=:id");
//    }

    public function dataview($query){
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0) {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['nr']); ?></td>
                    <td><?php print($row['rnavn']); ?></td>
                    <td><?php print($row['tilstand']); ?></td>
                    <td><?php print($row['beskrivelse']); ?></td>
                    <td><?php print($row['max_gjester']); ?></td>
                    <td><?php print($row['navn']); ?></td>
                    <td><?php print($row['city']); ?></td>
                    <td><?php print($row['land']); ?></td>
                    <td align="center">
                        <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
            <?php
        }

    }

    public function paging($query,$records_per_page){
        $starting_position=0;
        if(isset($_GET["page_no"])) {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query,$records_per_page){

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if($total_no_of_records > 0) {
            ?><ul class="pagination"><?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"])) {
                $current_page=$_GET["page_no"];
            }
            if($current_page!=1) {
                $previous =$current_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for($i=1;$i<=$total_no_of_pages;$i++) {
                if($i==$current_page) {
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                } else {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages) {
                $next=$current_page+1;
                echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }

}
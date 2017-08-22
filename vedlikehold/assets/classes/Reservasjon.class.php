<?php

/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 24.01.2017
 * Time: 08.43
 */
class Reservasjon
{
    public $conn;

    function __construct(){
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn=$db;
    }

    public function create($inndato, $utdato, $rom_id, $fornavn, $etternavn, $refkey){
        try{
            $stmt = $this->conn->prepare("INSERT INTO reservasjon(inndato, utdato, rom_id, fornavn, etternavn, refkey) VALUES(:inndato, :utdato, :rom_id, :fornavn, :etternavn, :refkey)");
            $stmt->bindParam(":inndato", $inndato);
            $stmt->bindParam(":utdato", $utdato);
            $stmt->bindParam(":rom_id", $rom_id);
            $stmt->bindParam(":fornavn", $fornavn);
            $stmt->bindParam(":etternavn", $etternavn);
            $stmt->bindParam(":refkey", $refkey);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }

    public function getID($id){
        $stmt = $this->conn->prepare("SELECT * FROM reservasjon WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id,$inndato,$utdato, $rom_id, $fornavn, $etternavn, $refkey){
        try{
            $stmt=$this->conn->prepare("UPDATE reservasjon SET inndato=:inndato, utdato=:utdato, rom_id=:rom_id, fornavn=:fornavn, etternavn=:etternavn, refkey=:refkey WHERE id=:id ");
            $stmt->bindParam(":inndato",$inndato);
            $stmt->bindParam(":utdato",$utdato);
            $stmt->bindParam(":rom_id", $rom_id);
            $stmt->bindParam(":fornavn", $fornavn);
            $stmt->bindParam(":etternavn", $etternavn);
            $stmt->bindParam(":refkey", $refkey);
            $stmt->bindParam(":id",$id);
            $stmt->execute();

            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM reservasjon WHERE id=:id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        return true;
    }

    /* paging */

    public function dataview($query){
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0){
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['inndato']); ?></td>
                    <td><?php print($row['utdato']); ?></td>
                    <td><?php print($row['rom_id']); ?></td>
                    <td><?php print($row['rnavn']); ?></td>
                    <td><?php print($row['fornavn']); ?></td>
                    <td><?php print($row['etternavn']); ?></td>
                    <td><?php print($row['refkey']); ?></td>
                    <td align="center">
                        <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                    </td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
            <?php
        }
    }

    public function paging($query,$records_per_page){
        $starting_position=0;
        if(isset($_GET["page_no"])){
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

        if($total_no_of_records > 0){
            ?><ul class="pagination"><?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"])){
                $current_page=$_GET["page_no"];
            }
            if($current_page!=1){
                $previous =$current_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for($i=1;$i<=$total_no_of_pages;$i++){
                if($i==$current_page){
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                }else{
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages){
                $next=$current_page+1;
                echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }

    /* paging */
}
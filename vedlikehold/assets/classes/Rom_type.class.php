<?php

/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 14.01.2017
 * Time: 13.10
 * TODO: gjøre denne slik at den arver fra klassen Rom, eg class Rom_type extends Rom
 */

class Rom_type
{
    public $conn;

    function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn=$db;
    }

    public function create($beskrivelse, $max_gjester) //TODO: Denne må redigeres per table
    {
        try
        {
            // TODO: Denne må forandres basert på tablen
            $stmt = $this->conn->prepare("INSERT INTO rom_type(beskrivelse, max_gjester) VALUES(:beskrivelse, :max_gjester)");
            $stmt->bindParam(":beskrivelse", $beskrivelse);
            $stmt->bindParam(":max_gjester",$max_gjester);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

    public function getID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM rom_type WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id,$beskrivelse,$max_gjester) // TODO: denne må redigeres per table
    {
        try
        {
            $stmt=$this->conn->prepare("UPDATE rom_type SET beskrivelse=:beskrivelse, max_gjester=:max_gjester WHERE id=:id ");
            $stmt->bindParam(":beskrivelse",$beskrivelse);
            $stmt->bindParam(":max_gjester",$max_gjester);
            $stmt->bindParam(":id",$id);
            $stmt->execute();

            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM rom_type WHERE id=:id");
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
                    <td><?php print($row['beskrivelse']); ?></td>
                    <td><?php print($row['max_gjester']); ?></td>
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
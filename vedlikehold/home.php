<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 17.27
 */

require_once("session.php");

$auth_user = new User();

$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php
include 'header.php';
include 'nav.php';
?>
<div class="clearfix"></div>

<div class="container-fluid" style="margin-top:80px;">

    <div class="container">

        <label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
        <hr />
        <h1>
            <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp;
            <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
        <hr />
        <p class="h4">User Home Page</p>



    </div>

</div>

<?php
include 'footer.php';
?>
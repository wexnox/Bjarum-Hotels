<?php

//$url = 'https://home.usn.no/web-is-gr10w/vedlikehold'; // TODO: denne må endres per server den står på
$url = 'http://192.168.0.109/phpeksamen/vedlikehold/';
$auth_user = new User();

$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo "$url";?>/">Bjarum Hoteller</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo "$url";?>/rom/index.php">Rom</a></li>
                    <li><a href="<?php echo "$url";?>/rom_type/index.php">Rom Type</a></li>
                    <li><a href="<?php echo "$url";?>/bilde/index.php">Bilde</a></li>
                    <li><a href="<?php echo "$url";?>/hotell/index.php">Hotell</a></li>
                    <li><a href="<?php echo "$url";?>/opptatt_rom/index.php">Opptatt Rom</a></li>
                    <li><a href="<?php echo "$url";?>/reservasjon/index.php">Reservasjon</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                            <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>
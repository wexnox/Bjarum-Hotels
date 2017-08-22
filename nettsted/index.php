<?php
include 'start.php';
include 'nav.php';
?>
<?php $url = 'https://home.usn.no/web-is-gr10w/nettsted'; ?>

<!-- banner -->
<div class="banner">
    <img src="<?php echo "$url";?>/assets/images/photos/banner.jpg"  class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">Bjarum Hotels</h1>
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->


<!-- reservation-information -->
<form action="bestill.php" method="POST" name="sok" id="sok">
    <div id="information" class="spacer reserve-info">
        <div class="container">
            <h2>Søk på hotell</h2>

            <div class="row">
                <div class="col-sm-4">
                    <h4>Hotell</h4>
                    <label for="hotell">
                        <select class="form-control" id="hotell" name="hotell">
                            <?php include("listeboks-hotell.php"); ?>
                        </select>
                    </label>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <h4>Fra</h4>
                    <label for="fra">
                        <input class="form-control" type="text" id="fra" name="fra" required />
                    </label>
                </div>

                <div class="col-sm-2">
                    <h4>Til</h4>
                    <label for="til">
                        <input class="form-control" type="text" id="til" name="til" required />
                    </label>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <h4>Type</h4>
                    <label for="romtype">
                        <select class="form-control" id="romtype" name="romtype">
                            <?php include("listeboks-romtype.php"); ?>
                        </select>
                    </label>
                </div>
            </div>
            <br>
            <button class="btn btn-default" type="submit" id="go" name="go" value="Søk" onClick="checkout()">Søk</button>
            <button class="btn btn-default" type="reset" id="null" name="null" value="Nullstill" onClick="checkout()">Nullstill</button>
        </div>
</form>
<?php include 'slutt.php'; ?>

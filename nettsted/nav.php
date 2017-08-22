<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 29.01.2017
 * Time: 22.33
 */
?>
<nav class="navbar  navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">
                <li><a href="index.php">Hjem </a></li>
                <li><a href="rom.php">Rom</a></li>
                <li><a href="minside.php">Min Side</a></li>
            </ul>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:3px 5px;">
                            <h4>Finn</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <form method="POST" name="sok" id="sok" action="minside.php">
                                <div class="form-group">
                                    <h4>Reservasjons ID</h4>
                                    <label for="refid">
                                        <input type="text" name="refid" id="refid">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <h4>Referansenummer</h4>
                                    <label for="refkey">
                                        <input type="text" name="refkey" id="refkey">
                                    </label>
                                </div>
                                <button class="btn btn-default" type="submit" id="go" name="go" value="Søk" onClick="checkout()">Søk</button>
                                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

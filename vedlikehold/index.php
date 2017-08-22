<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 17.27
 */

session_start();
include 'assets/common.php';
$login = new User();

if($login->is_loggedin()!="")
{
    $login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
    $uname = strip_tags($_POST['txt_uname_email']);
    $umail = strip_tags($_POST['txt_uname_email']);
    $upass = strip_tags($_POST['txt_password']);

    if($login->doLogin($uname,$umail,$upass))
    {
        $login->redirect('home.php');
    }
    else
    {
        $error = "Wrong Details !";
    }
}
?>
<?php
include 'header.php';
?>

    <div class="signin-form">
        <div class="container">
            <form class="form-signin" method="post" id="login-form">
                <h2 class="form-signin-heading">Log In</h2><hr />
                <div id="error">
                    <?php
                    if(isset($error))
                    {
                        ?>
                        <div class="alert alert-danger">
                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="username" class="sr-only"></label>
                    <input type="text" class="form-control" name="txt_uname_email" id="username" placeholder="Enter Username" required >
                    <label for="password" class="sr-only"></label>
                    <input type="password" class="form-control" name="txt_password" id="password" placeholder="Your Password" >
                </div>
                <button type="submit" name="btn-login" class="btn btn-default"><i class="glyphicon glyphicon-log-in"></i> SIGN IN</button>
                <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
            </form>
        </div>
    </div>
<?php
include 'footer.php';
?>
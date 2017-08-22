<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 17.28
 */
require_once('session.php');
include 'assets/common.php';
$user_logout = new User();

if($user_logout->is_loggedin()!="")
{
    $user_logout->redirect('home.php');
}
if(isset($_GET['logout']) && $_GET['logout']=="true")
{
    $user_logout->doLogout();
    $user_logout->redirect('sok.php');
}

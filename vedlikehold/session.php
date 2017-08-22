<?php
/**
 * Created by PhpStorm.
 * User: wexnox
 * Date: 06.01.2017
 * Time: 17.28
 */

session_start();
include 'assets/common.php';
$session = new User();
//$url = 'https://home.usn.no/web-is-gr10w/vedlikehold'; // TODO: må fikse redirect
$url = 'http://192.168.0.109/phpeksamen/vedlikehold/';

// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
// put this file within secured pages that users (users can't access without login)

if(!$session->is_loggedin())
{
    // session no set redirects to login page
    $session->redirect($url);
}
<?php
/*  author: smiks
    version: 0.8.2
    latest bigger upgrades: 
    - gzip compression (auto detect if broswer supports it)
    - function render in controller (caches view)
*/
session_start();
#ob_start();
#header("Cache-Control: max-age=86400");
require_once 'config/page_settings.php';
require_once 'config/config.php';
require_once 'config/connect.php';
require_once 'core/Router.php';
require_once 'core/Functions.php';
require_once 'core/Global.php';

if($_PAGE_LOAD_TIME){
    $_PAGE_LOAD_START = microtime(true);
}
/* to be completed when needed */
if(!isset($_GET['page']) && isset($_SESSION['doctorID'])){
    $_GET['page'] = "dashboard";
}
if(!isset($_GET['page']) && !isset($_SESSION['doctorID'])){
    $_GET['page'] = "home";
}
if(!isset($_SESSION['loggedin']) && $_GET['page'] != "logindoctor"){
    $_GET['page'] = "login";
}
/* routing */
Router::home('home', 'app/controllers/Home.php');
Router::set(array(
    'login' => 'app/controllers/Login.php',
    'postdata' => 'app/controllers/PostData.php',
    'logindoctor' => 'app/controllers/LoginDoctor.php',
    'dashboard' => 'app/controllers/Dashboard.php',
    'logout' => 'app/controllers/Logout.php',
    'logoutdoctor' => 'app/controllers/LogoutDoctor.php',
    'updatestatus' => 'app/controllers/UpdateStatus.php',
    'home' => 'app/controllers/Home.php',
    'patienthistory' => 'app/controllers/PatientHistory.php'
    ));
Router::route();


if($_PAGE_LOAD_TIME){
    $pageLoad = number_format( ((microtime(true) - $_PAGE_LOAD_START)*1000) , 2);
    echo"<font color='#FFF'><br>Page loaded in {$pageLoad}ms</font>";
}
if($_NUM_QUERIES){
    echo"<font color='#FFF'><br>{$db->num_queries} queries</font>";
}
if($_MEMORY_USAGE){
    $memory = number_format(memory_get_usage()/(1024*1024),2);
    $maxMemory = number_format(memory_get_peak_usage()/(1024*1024), 2);
    echo"<font color='#FFF'><br>Memory usage: {$memory }MB (Peak: {$maxMemory} MB)</font>";
}
if($_DEBUG){
    echo"<div style='overflow:auto; color:#FFF'>DEBUG MODE<br>";
    debug_print_backtrace();
    echo"<hr>";
    echo"Last error <br>";
    print_r(error_get_last());
    echo"</div>";
}

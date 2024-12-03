<?php
include '../util/common.php';

session_start();
if(isset($_SESSION['auth'])){
    $auth = unserialize($_SESSION['auth']);
    if(!$auth->isEnable()){
        header("Location: login.php");
    }
}else{
    header("Location: login.php");
}
<?php
include_once '../bin/db_connect.php';
include_once '../bin/functions.php';

sec_session_start();
if (isset($_SESSION['type'])){
    if ($_SESSION['type'] == 'admin'){
        header("Location: http://localhost/miniproject/modules/SuperUser/index.php");
    } elseif ($_SESSION['type'] == 'supervisor') {
        header("Location: http://localhost/miniproject/modules/Visor/index.php");
    } elseif ($_SESSION['type'] == 'student') {
        header("Location: http://localhost/miniproject/modules/Student/index.php");
    } else {
        header("Location: http://localhost/miniproject/");
    }
} else {
    header("Location: http://localhost/miniproject/");
}
?>

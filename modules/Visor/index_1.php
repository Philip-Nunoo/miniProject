<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../bin/db_connect.php';
include_once '../../bin/functions.php';
sec_session_start();
if(!login_check() || ($_SESSION['type'] != "admin")) {
    header("Location: http://localhost/miniproject/");
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mini project</title>
        <link href="../../css/sytle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <a href="http://localhost/miniproject/scripts/logout.php">Logout</a>
        <ul>
            <li><a href="createSuper.php">Create Lecturer</a></li>
            <li><a href="viewSuper.php">View registered Supervisors</a></li>
            <li><a>Create New admin</a></li>
        </ul>
    </body>
</html>

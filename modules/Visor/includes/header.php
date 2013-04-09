<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    include_once '../../bin/db_connect.php';
    include_once '../../bin/functions.php';
    
    sec_session_start();
    if(!login_check() || ($_SESSION['type'] != "supervisor")){
        header("Location: http://localhost/miniproject/");
        die();
    }
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mini Project | Supervisor</title>
        <link rel="stylesheet" type="text/css" href="../../css/sytle.css"/>
    </head>
    <body>
        <div id="header" style="background-color: #139ff7;">
            <div id="container">
                <div id="page"><a href="index.php">Index Page | Visor</a></div>
                <div id="welcome">
                    <span class="welcome">Welcome, </span>
                    <span class="name">Mr/Mrs <?php echo $firstName. " ".$lastName?>
                        <p><a href="../../scripts/logout.php">Logout Now</a></p>
                    </span>
                </div>
            </div>            
        </div>
        <div class="clear"></div>
        <div id="navigation">
            <input type="text" value="Search Item"/><br/>
            <p>
                <a href="addStudent.php">Create/Add Student</a><br/>
                <a href="viewAllStudents.php">View All Students</a><br/>
            </p>
            <p>
                Create Message</br>
                <a href="viewMessages.php">View All Messages</a></br>
            </p>
        </div>
        <div id="mainArea">
            <div id="content">

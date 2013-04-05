<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    include_once "../../bin/db_connect.php";
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
        <title>Mini Project</title>
        <link type="text/css" rel="stylesheet" href="../../css/sytle.css"/>
    </head>
    <body>
        <a href="http://localhost/miniproject/scripts/logout">Logout</a>
    <fieldset>
        <legend>Create Supervisor</legend>
        <table>
            <form action="http://localhost/miniproject/scripts/addSupervisor.php" method="POST">
                <tr><td>Lecturers First Name:</td><td><input type="text" name="firstname"/></td></tr>
                <tr><td>Lecturers Last Name:</td><td><input type="text" name="lastname"/></td></tr>
                <tr><td>Qualification:</td><td><input type="text" name="qualification"/></td></tr>
                <tr><td>Specialty:</td><td><input type="text" name="specialty"/></td></tr>
                <tr><td>Email:</td><td><input type="text" name="email"/></td></tr>
                <tr><td>Notes:</td><td><textarea name="note"></textarea></td></tr>
                <tr><td></td>
                    <td>
                        <input type="submit" value="Add +"/><input type="button" value="Clear"/>
                        <input type="hidden" name="AddSupervisor"/>
                    </td>
                </tr>
            </form>
            <?php 
            if(isset($_GET['error'])){echo '<div id="">Error cann\'t enter value.
            <br/>Or duplicate entry';}
            ?>
        <?php
        if (isset($_GET['add'])){
            echo '<div id=""> Email has been sent to User.</div>';            
        }
        ?>
    </fieldset>
    </body>
</html>

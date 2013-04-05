<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include_once '../../bin/db_connect.php';
    include_once '../../bin/functions.php';
    include_once '../../bin/module.php';
    
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
        <link href="../../css/sytle.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <a href="http://localhost/miniproject/scripts/logout.php">Logout</a>
        <?php $results = getSupervisors();?>
        <table border='1'>
            <tr><th>Department</th><th>First Name</th><th>Last Name</th>
                <th>Email</th><th>Number of Students</th>
                <th></th>
            </tr>
        <?php while ($result = mysql_fetch_array($results, MYSQL_ASSOC) ) :?>
            <tr><td><?php echo $result['department_name']?></td>
                <td><?php echo $result['firstName'];?></td>
                <td><?php echo $result['lastName'];?></td>
                <td>Not available now</td>
                <td><?php echo $result['email']?></td>
                <td><a href="edit?id=<?php echo $result['supervisor_id']?>"> Edit</a> | 
                    <a href="details?id=<?php echo $result['supervisor_id']?>">Details </a></td>
            </tr>
        <?php endwhile;?>
        </table>
    </body>
</html>

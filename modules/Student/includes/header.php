<?php
    include_once '../../bin/db_connect.php';
    include_once '../../bin/functions.php';
    include_once './functions/student_functions.php';
    
    sec_session_start();
    if(!login_check() || ($_SESSION['type'] != "student")){
        header("Location: http://localhost/miniproject/index.php?location=".  urlencode($_SERVER['REQUEST_URI']));
        die();
    }
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mini Project</title>
        <link rel="stylesheet" type="text/css" href="../../css/sytle.css"/>              
    </head>
    <body>
        <div id="header">
        <div id="container">
            <div id="page"><a href="index.php">Index Page</a></div>
            <div id="welcome">
                <span class="welcome">Welcome,</span> 
                <span class="name"><?php echo $firstName." ".$lastName;?>
                    <p><a href="../../scripts/logout.php">Logout</a></p>
                </span>
            </div>
        </div>
        </div>
        <div class="clear"></div>
        <div id="navigation">
            <input type="text" value="Search For item"/><br/>
            
            <div>
                <h3>Projects</h3>
                <a href="createProject.php">Create Project</a><br/>
                <?php $results = getProjects();?>
                
                <p>
                <?php if (mysql_num_rows($results) != 0):?>
                    <?php while ($result = mysql_fetch_row($results, MYSQL_ASSOC)):?>
                    <a href="project.php?id=<?php echo $result['id'];?>"><?php echo $result['name']?></a><br/>
                    <?php endwhile;?>
                <?php else:?>
                    Start Creating your project and manage them from
                    this point.
                <?php endif;?>
                </p>
            </div>
            
            <div id="file">
                <h3>Documents</h3>
                <a href="createFile.php">Create File</a><br/>
                <a href="viewFiles.php">View my documents</a><br/>
                View deleted Files<br/>
            </div>
            
<div id="messages">
    <h3>Messages</h3>
    Create New Message<br/>
    View sent messages<br/>
    View received messages<br/>
    View deleted message<br/>
</div>

<div id="settings">
    <h3>Settings</h3>
    Edit Profile<br/>
    View Profile<br/>
    Logout<br/>
</div>
        </div>
<div id="mainArea">
    <div id="content">
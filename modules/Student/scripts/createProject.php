<?php
/*
 * Script to create a new Project
 */
include_once "../functions/student_functions.php";

$name = $_POST['name'];
$description = $_POST['description'];

if(isset($_POST['other']) && $_POST['other']!=""){
    $type = $_POST['other'];
} else {
    $type = $_POST['type'];
}

if(isset($name, $type) && $name!="" && $type !=""){
    $result = createDocument($name, $type, $description);
    header("Location: ../project.php?id={$result}");
    die();
}
else{
    header("Location: ../createProject.php?error=0");
}
?>

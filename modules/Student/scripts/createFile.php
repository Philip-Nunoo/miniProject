<?php
include_once '../../../bin/db_connect.php';
include_once '../../../bin/functions.php';
include_once '../functions/student_functions.php';

$content = $_POST['createForm'];
$document_name = $_POST['document_name'];

if(isset($content) && $content !="" && isset($document_name) && $document_name!="")
{
    //$content = htmlentities($content); //format the html tags
    // Call the function to save the content in database
    if(isset($_POST['document_id']) && $_POST['document_id']!="") {
        $document_id = $_POST['document_id'];
        $result = updateFile($content, $document_id, $document_name);
    } else {
        if(isset($_POST['submit']) && $_POST['submit'] != ""){
            $result = createFile($content, $document_name, $submit);
        } else {
            $result = createFile($content, $document_name);
        }
    }
    
    if($result != FALSE) {
        $url = "http://localhost/miniproject/modules/Student/createFile.php?message=success&&document_id=".$result;
        header("Location:".$url);
        die();
    } else {
        header("Location: http://localhost/miniproject/modules/Student/createFile.php?message=fail");
        die();
    }
//$content = html_entity_decode($content);
}  else {
    if($document_name=="") {
        header("Location: http://localhost/miniproject/modules/Student/createFile.php?error=document_name_error");
    } else {
        header("Location: http://localhost/miniproject/modules/Student/createFile.php?error=true");
    }
}
?>

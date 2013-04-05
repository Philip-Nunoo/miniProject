<?php
include_once '../functions/student_functions.php';
$document_id = $_GET['id'];
$result = deleteFile($document_id);
if ($result == 'TRUE') {
    header ("Location: http://localhost/miniproject/modules/Student/viewFiles.php?error=FALSE");
} else {
    header ("Location: http://localhost/miniproject/modules/Student/viewFiles.php?error=".$result);
}
?>

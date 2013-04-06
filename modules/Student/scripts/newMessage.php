<?php
include_once '../../../bin/db_connect.php';
include_once '../functions/student_functions.php';

if (isset($_POST['subject'],$_POST['to'],$_POST['message'])) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    if (newMessage($subject, $message) == TRUE) {
        header("Location: ../newMessage.php?id=1");
    } else {
        echo "error";
    }
} else {
    //header("Location: ../newMessage.php?id=0");
    echo "{$_POST['to']} | {$_POST['subject']} | {$_POST['message']}";
}
?>

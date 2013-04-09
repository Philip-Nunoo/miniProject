<?php
include_once '../../../bin/db_connect.php';
include_once '../functions/student_functions.php';
include_once '../../../bin/functions.php';

sec_session_start();

if (isset($_POST['subject'],$_POST['to'],$_POST['message'])) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    $student_id = $_SESSION['user_id'];
    $supervisor_id = $_SESSION['super_id'];
    
    //echo "<p>Student Id: {$student_id}<br/>Supervisr_id: {$supervisor_id}</p>";
    $from = getStudentAddress($student_id);
    $to = getSupervisorAddress($supervisor_id);
    //echo "From: {$from}<br/>To: {$to}";
    
    if (newMessage($subject, $message, $from, $to) == TRUE) {
        header("Location: ../newMessage.php?id=1");
    } else {
        echo "error";
    }
} else {
    //header("Location: ../newMessage.php?id=0");
    echo "{$_POST['to']} | {$_POST['subject']} | {$_POST['message']}";
}
?>

<?php
include_once '../../../bin/db_connect.php';
include_once '../../../bin/functions.php';

    sec_session_start();
    function getStudents() {
        $supervisor_id = $_SESSION['user_id'];
        $query = "SELECT * FROM student 
                  WHERE supervisor_id = $supervisor_id";
        $results = mysql_query($query) or die(mysql_error());
        
        return $results;
    }
    
    function viewAllMessages() {
        $supervisor_id = $_SESSION['user_id'];
        $supervisor_address = getSupervisorAddress($supervisor_id);
        
        $query = "SELECT * 
                  FROM messages a
                  JOIN message_doc b
                  ON a.message_id = b.id
                  WHERE a.to_address = '$supervisor_address'";
        
        $results = mysql_query($query) or die("View All Messages error: " .mysql_error());
        
        return $results;
    }
    
    function viewMessage($message_id) {
        $query = "SELECT * 
                  FROM messages a
                  JOIN message_doc b
                  ON a.message_id = b.id
                  WHERE a.id = $message_id";
        
        $result = mysql_query($query) or die("View Message Error: " . mysql_error());
        
        return $result;
    }
    
    function getStudentName($student_id) {
        $query = "SELECT firstName, lastName
                  FROM student
                  WHERE id = $student_id";
        
        
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);
        
        echo $row['firstName'] . " " . $row['lastName'];
    }
?>
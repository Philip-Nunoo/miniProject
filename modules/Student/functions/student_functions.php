<?php
include_once '../../../bin/db_connect.php';
include_once '../../../bin/functions.php';

    sec_session_start();
    
    function createFile($content, $document_name, $submit=0) {
        $student_id = $_SESSION['user_id'];
        $content = htmlentities($content);    
        $date_created = $date_updated = date("Y-m-d");

        $query = "INSERT INTO student_doc 
            (student_id, content, date_created, date_updated, doc_name) VALUES
            ('$student_id', '$content', '$date_created','$date_updated','$document_name')";
        
        mysql_query($query) or die(mysql_error());    
        $document_id = mysql_insert_id();

        return $document_id;
    }
    
    function getFiles() {
        $student_id = $_SESSION['user_id'];
        $query = "SELECT * FROM student_doc WHERE student_id = '$student_id'";
        
        $result = mysql_query($query) or die(mysql_error());
        
        return $result;
    }
    
    function deleteFile($document_id) {
        $query = "DELETE FROM student_doc WHERE id = '$document_id'";
        $result = mysql_query($query);
        
        if ($result) {
            return 'TRUE';
            die();
        } else {
            $error = mysql_error();
            return $error;
            die();
        }
        
    }
    
    function viewFile($id) {
        $id=$_GET['id'];
        $query="SELECT content FROM student_doc WHERE id = '$id'";

        $result = mysql_query($query) or die(mysql_error());
        return html_entity_decode(mysql_result($result, 0));
    }
    
    function getDocumentName($document_id){
        $query = "SELECT doc_name FROM student_doc WHERE id = '$document_id'";
        $result = mysql_query($query) or die(mysql_error());
        
        return mysql_result($result, 0);
    }
    
    function createDocument($name, $type, $description) {
        $student_id = $_SESSION['user_id'];
        
        $query = "INSERT INTO projects (student_id, name, type, description)
            VALUES ('$student_id', '$name', '$type', '$description')";
        
        mysql_query($query) or die(mysql_error());
        
        return mysql_insert_id();
    }
    
    function getProjects($project_id = FALSE) {
        $student_id = $_SESSION['user_id'];
        if ($project_id){
            $query = "SELECT * FROM projects WHERE id='$project_id'";
        } else {
            $query = "SELECT * FROM projects WHERE student_id = '$student_id'";
        }
        
        $result = mysql_query($query) or die(mysql_error());
        
        return $result;
    }
?>
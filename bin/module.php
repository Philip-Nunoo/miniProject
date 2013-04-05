<?php
include_once './db_connect.php';
include_once './functions.php';

sec_session_start();
function addSupervisor($inputArray) {    
    $firstname = $inputArray['firstname'];
    $lastname = $inputArray['lastname'];
    $qualification = $inputArray['qualification'];
    $specialty = $inputArray['specialty'];
    $email = $inputArray['email'];
    $note = $inputArray['note'];
    
    $department_id = $_SESSION['department_id'];
    $username = strtolower($firstname.$lastname);
    $password = substr(strrev($username),1 ,9);
    
    $arrayinput['username'] = $username;
    $arrayinput['email'] = $email;
    $arrayinput['password'] = $password;
    $arrayinput['type'] = "supervisor";
    
    $value = registerUser($arrayinput, $department_id);
    
    if ($value){
        $query = "SELECT id FROM supervisors WHERE email='$email'";
        $result = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result)>1){
            return FALSE;
        }
        $query = "INSERT INTO supervisors 
            (department_id, department_user_id, firstName, lastName, qualification, speciality, email, notes, pass) 
            VALUES 
            ('$department_id','$value','$firstname', '$lastname', '$qualification', '$specialty', '$email', '$note', '$password')";
        mysql_query($query) or die(mysql_error());
        return TRUE;
    }
}

function getSupervisors() {
    $department_id = $_SESSION['department_id'];
    
    $query = "SELECT * FROM supervisors
        AS a, department As b 
        WHERE a.department_id = b.department_id";
    $result = mysql_query($query) or die(mysql_error());
    //$result = mysql_fetch_array($result);
    return $result;
}

function addStudent($inputArray) {
    $firstname = $inputArray['firstname'];
    $lastname =$inputArray['lastname'];
    $email = $inputArray['email'];
    $year = $inputArray['year'];
    $strength = $inputArray['strength'];
    $note = $inputArray['note'];
    
    $department_id = $_SESSION['department_id'];
    $username = strtolower($firstname.$lastname);
    $password = substr(strrev($username),1 ,9);
    
    $arrayinput['username'] = $username;
    $arrayinput['email'] = $email;
    $arrayinput['password'] = $password;
    $arrayinput['type'] = "student";
    
    $value = registerUser($arrayinput, $department_id);
    if ($value){
        $query = "SELECT id FROM student WHERE email='$email'";
        $result = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($result)>1){
            return FALSE;
        }
        $supervisor_id = $_SESSION['user_id'];
        $query = "INSERT INTO student 
            (supervisor_id, user_id, firstName, lastName, email, year, strength, note, pass) 
            VALUES 
            ('$supervisor_id','$value','$firstname', '$lastname', '$email', '$year', '$strength', '$note', '$password')";
        mysql_query($query) or die(mysql_error());
        return TRUE;
    }
}

function updateFile($content,$document_id,$doc_name) {
    $date_updated = date("Y-m-d");
    $content = htmlentities($content);
    
    $query = "UPDATE student_doc
        SET content = '$content',
            date_updated = '$date_updated',
            doc_name = '$doc_name'
        WHERE id = '$document_id'";
    mysql_query($query) or dir(mysql_error());
    return $document_id;
}

function getFileContent($document_id) {
    $query = "SELECT content FROM student_doc WHERE id ='$document_id'";
    $result = mysql_query($query) or die(mysql_error);
    
    return html_entity_decode(mysql_result($result, 0));
}
?>

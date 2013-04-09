<?php
include_once '../bin/db_connect.php';
include_once '../bin/functions.php';
include_once '../bin/module.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$year = $_POST['year'];
$strength = $_POST['strength'];
$note = $_POST['note'];

if(isset($firstname) && isset($lastname) && isset($email) && isset($year)
        && isset($strength) && isset($note) && 
        $firstname!="" && $lastname!="" && $email!="" && $year!="" && $strength!=""
        && $note!=""){
    $inputArray['firstname'] = $firstname;
    $inputArray['lastname'] = $lastname;
    $inputArray['email'] = $email;
    $inputArray['year'] = $year;
    $inputArray['strength'] = $strength;
    $inputArray['note'] = $note;
    
    if(addStudent($inputArray)){
        header("Location: http://localhost/miniproject/modules/Visor/addStudent.php?add=TRUE");
    }
    else{
        header("Location: http://localhost/miniproject/modules/Visor/addStudent.php?error=TRUE");
    }
} else {
    echo "Not set";
}
?>

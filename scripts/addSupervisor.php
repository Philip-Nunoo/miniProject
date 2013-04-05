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
$qualification = $_POST['qualification'];
$specialty = $_POST['specialty'];
$email = $_POST['email'];
$note = $_POST['note'];

if(isset($firstname) && isset($lastname) && isset($qualification) &&
        isset($specialty) && isset($email) && isset($note) && $firstname!=""
        && $lastname!="" && $qualification!="" && $specialty!="" && $email!=""
        ){
    
    
    $inputArray['firstname'] = $firstname;
    $inputArray['lastname'] = $lastname;
    $inputArray['qualification'] = $qualification;
    $inputArray['specialty'] = $specialty;
    $inputArray['email'] = $email;
    $inputArray['note'] = $note;
    
    if (addSupervisor($inputArray)){
        header("Location: http://localhost/miniproject/modules/SuperUser/createSuper.php?add=TRUE");
    }
    else{
        header("Location: http://localhost/miniproject/modules/SuperUser/createSuper.php?error=TRUE");
    }
} else {
    header("Location: http://localhost/miniproject/modules/SuperUser/createSuper.php");
}
?>

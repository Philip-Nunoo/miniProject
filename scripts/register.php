<?php
include '../bin/functions.php';
include '../bin/db_connect.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * `firstName``lastName``qualification``speciality``email``notes`
 */
$departmentName = $_POST['departmentName'];
$Hod = $_POST['Hod'];
$College = 'College of Science';
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$username = $_POST['username'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$register = $_POST['register'];

if(isset($departmentName) && isset($Hod) && isset($College) && isset($firstName)
        && isset($lastName) && isset($username) && isset($email) && isset($pass1) && isset($pass2) && isset($register))
    {
    
    if ($pass1 != $pass2){
        // checking if passwords entered are the same from the password fields
        $_GET['pass'] = TRUE;
        header('Location: http://localhost/miniproject/register.php?pass=1');
    }
    $password = $pass1;
    
    // Add your insert to database script here. 
    // Make sure you use prepared statements!
    $query = "INSERT INTO department (department_name, hod, college)
        VALUES ('$departmentName', '$Hod','$College')";
    mysql_query($query) or die (mysql_error());
    $departmentID = mysql_insert_id();
    
    $arrayinput['department_id'] = $departmentID;
    $arrayinput['username'] = $username;
    $arrayinput['email'] = $email;
    $arrayinput['password'] = $password;
    $arrayinput['type'] = "admin";
    
    if(registerUser($arrayinput, $departmentID)){
        header("Location: http://localhost/miniproject/index.php");        
    }
}
?>

<?php
include_once './db_connect.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function sec_session_start() {
    $session_name = 'sec_session_id'; // Set a custom session name
    $secure = false; // Set to true if using https.
    $httponly = true; // This stops javascript being able to access the session id. 

    ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
    $cookieParams = session_get_cookie_params(); // Gets current cookies params.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
    session_name($session_name); // Sets the session name to the one set above.
    session_start(); // Start the php session
    session_regenerate_id(true); // regenerated the session, delete the old one.     
}

function setSessionParams($userData) {
    sec_session_start();
    $ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user. 
    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
    $id = preg_replace("/[^0-9]+/", "", $userData['id']); // XSS protection as we might print this value
    $_SESSION['id'] = $id;
    $_SESSION['user_id'] =$user_id;
    
    if($userData['type'] == 'supervisor') {
        // If its a supervisor that's is requesting a login set these session variable
        $query = "SELECT supervisor_id, firstName, lastName, email
            FROM supervisors 
            WHERE department_user_id = '$id'";
        $result = mysql_query($query);
        $Data = mysql_fetch_array($result,MYSQL_ASSOC);
        $super_id = preg_replace("/[^0-9]+/", "", $Data['supervisor_id']); // XSS protection as we might print this value
        $_SESSION['user_id'] = $super_id;            // session variable/array for user id
        $_SESSION['firstName'] = $Data['firstName'];// session variable/array for firstName of user
        $_SESSION['lastName'] = $Data['lastName'];  // session variable/array for lastName of user
    } else {
        // if it's a student login in set these session variables
        $query = "SELECT id, supervisor_id, firstName, lastName, email, year
            FROM student
            WHERE user_id = '$id'";
        $result = mysql_query($query);
        $Data = mysql_fetch_array($result,MYSQL_ASSOC);
        $super_id = preg_replace("/[^0-9]+/", "", $Data['supervisor_id']); // XSS protection as we might print this value
        $user_id = preg_replace("/[^0-9]+/", "", $Data['id']); // XSS protection as we might print this value
        $_SESSION['super_id'] = $super_id;              // students supervisor id
        $_SESSION['user_id'] = $user_id;                // students id
        $_SESSION['firstName'] = $Data['firstName'];
        $_SESSION['lastName'] = $Data['lastName'];
        $_SESSION['year'] = $Data['year'];
    }
    $_SESSION['type'] = $userData['type'];
    $_SESSION['department_id'] = $userData['department_id'];
    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $userData['username']); // XSS protection as we might print this value
    $_SESSION['username'] = $username;
    $_SESSION['login_string'] = hash('sha512', $userData['password'].$ip_address.$user_browser);
}

function registerUser($arrayinput, $department_id) {
    $departmentID = $department_id;
    $username = $arrayinput['username'];
    $email = $arrayinput['email'];
    $password = $arrayinput['password'];
    $type = $arrayinput['type'];
            
    $query = "SELECT id FROM department_users WHERE email='$email'";
    
    $result = mysql_query($query) or die(mysql_error());
    if (mysql_num_rows($result) == 1){
        return FALSE;
    }
    $salt = createSalt();
    $hash = hash('sha256', $password);
    $hash = hash('sha256', $salt . $hash);
    
    $query = "INSERT INTO department_users (department_id, username, email, password, salt, type) 
        VALUES('$departmentID', '$username', '$email', '$hash', '$salt', '$type')";
    mysql_query($query) or die (mysql_error());
    return mysql_insert_id();
    
}

function login($email, $password, $conn) {
   // Using prepared Statements means that SQL injection is not possible.
    $query = "SELECT * FROM department_users WHERE email = '$email' LIMIT 1";
    $result = mysql_query($query) or die(mysql_error());
    
    if (mysql_num_rows($result) == 1){// If the user exists
         // We check if the account is locked from too many login attempts
        if (checkbrute($user_id, $conn) == true) {
            // Account is locked
            // Send an email to user saying account is locked
            return FALSE;
        } else {
            $userData = mysql_fetch_array($result,MYSQL_ASSOC);
            $hash = hash('sha256', $userData['salt'] . hash('sha256', $password));
            if($hash == $userData['password']){
                setSessionParams($userData);
                // Login successful.
                return TRUE;
            } else {
            // Password is not correct
            // We record this attempt in the database
                $now = time();
                $query ="INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')";
                mysql_query($query);
                return FALSE;
            }
        }
    } else {
        // No user exists. 
        return false;
      }
}

function checkbrute($user_id, $conn) {
   // Get timestamp of current time
   $now = time();
   // All login attempts are counted from the past 2 hours. 
   $valid_attempts = $now - (2 * 60 * 60); 
   $query = "SELECT time FROM login_attempts WHERE user_id = '$user_id' AND time > '$valid_attempts'";
   $result = mysql_query($query);
   if (mysql_num_rows($result) > 5){
       return TRUE;
   } else {
       return FALSE;
   }
}

function login_check() {
   // Check if all session variables are set
   if(isset($_SESSION['user_id'], $_SESSION['id'], $_SESSION['login_string'])) {
     $id = $_SESSION['id'];
     $login_string = $_SESSION['login_string'];
     $ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user. 
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
     
     $query = "SELECT password FROM department_users WHERE id = '$id' LIMIT 1";
     $result = mysql_query($query) or die(mysql_error());
     
     if(mysql_num_rows($result) == 1){
         $userData = mysql_fetch_array($result);
         $login_check = hash('sha512', $userData['password'].$ip_address.$user_browser);
         if($login_check == $login_string) {
             // Logged In!!!
             return TRUE;
         } else {
             // Not Logged In
             return FALSE;
         }
     } else {
         // Not logged in
         return FALSE;
     }
     
    }
}

//creates a 3 character sequence
function createSalt()
{
    $string = md5(uniqid(rand(), true));
    return substr($string, 0, 3);
}
    
function getSupervisorAddress($supervisor_id) {
    $query = "SELECT email FROM supervisors WHERE supervisor_id = $supervisor_id";
    $result = mysql_query($query) or die("Get Supervisor Error: " .mysql_error());

    $row = mysql_fetch_array($result);
    return $row['email'];
}

function getStudentAddress($student_id) {
    $query = "SELECT email FROM student WHERE id = $student_id";
    $result = mysql_query($query) or die("Get Student sql error: " .mysql_error());
    $row = mysql_fetch_array($result);
    return $row['email'];
}
?>

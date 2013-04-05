<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<? 
include_once './bin/db_connect.php';
include_once './bin/functions.php';
sec_session_start();
if(login_check()){
    header("Location: ./modules/SuperUser/index.php");
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Mini Project</title>
        <link rel="stylesheet" type="text/css" href="css/sytle.css"/>
    </head>
    <body>
        <form action="scripts/register.php" method="POST">
        <fieldset id="registration">
            <legend>Registration page</legend>
            <table>
                    <tr><td>Department Name:</td><td><input type="text" name="departmentName"/></td></tr>
                    <tr><td>Name of HOD:</td><td><input type="text" name="Hod"/></td></tr>
                    <tr><td>College</td><td>
                            <select><option>College of Science</option></select>
                        </td>
                    </tr>                
            </table>
        </fieldset>
        <fieldset id="registration">
            <legend>Registration user details</legend>
            <table>
                <tr><td>First Name:</td><td><input type="text" name="firstName"/></td></tr>
                <tr><td>Last Name:</td><td><input type="text" name="lastName"/></td></tr>
                <tr><td>Username: </td><td><input type="text" name="username"/></td></tr>
                <tr><td>Email: </td><td><input type="text" name="email"/></td></tr>
                <tr><td>Password:</td><td><input type="password" name="pass1"/></td></tr>
                <tr><td>Re-enter Password:</td>
                    <td><input type="password" name="pass2"/>
                        <p class="error"><?php if(isset($_GET['pass'])){echo 'password mismatch.';}?></p>
                    </td>
                </tr>
                <tr><td></td><td><input type="submit" value="Register"/><input type="hidden" name="register"/></td></tr>
            </table>
        </fieldset>
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>

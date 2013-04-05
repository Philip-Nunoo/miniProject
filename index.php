<!DOCTYPE html>
<? 
include_once './bin/db_connect.php';
include_once './bin/functions.php';
sec_session_start();
if(login_check()){
    header("Location: http://localhost/miniproject/modules/redirect.php");
    die();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/sytle.css"/>
        <script type="text/javascript" src="js/forms.js"></script>
        <title>Mini Project</title>
    </head>
    <body>
        <fieldset id="login">
            <legend><h3>Login</h3></legend>
            <table>
                <form action="scripts/process_login.php" method="POST">
                <tr><td>Email</td><td><input type="text" name="email"/></td></tr>
                <tr><td>Password</td><td><input type="password" name="password"/></td></tr>
                <tr><td></td>
                    <td>
                        <input type="hidden" name="location" value="
                            <?php 
                            if(isset($_GET['location'])){
                                echo htmlspecialchars($_GET['location']);
                            }
                            ?>"
                         />
                        <input type="submit" name="submit" value="Login"/>
                    </td>
                </tr>
                <tr><td></td><td><a href="register.php">Register</a></td></tr>
                <tr><td></td>
                    <td class="error">
                    <?php 
                        if(isset($_GET['error'])){
                            $error=$_GET['error'];
                            if ($error == "1"){
                                echo 'Invalid email or password.';
                            } else {
                                echo 'Please fill out the fields.';
                            }
                        }
                    ?>
                    </td>
                </tr>
                </form>
            </table>
        </fieldset>
    </body>
</html>
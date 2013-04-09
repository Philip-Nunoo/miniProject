<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once './includes/header.php';?>
        <fieldset>
            <legend>Add Student</legend>
            <form action="./scripts/addStudent.php" method="POST">
            <table>
                    <tr><td>First Name:</td><td><input type="text" name="firstname"/></td></tr>
                    <tr><td>Last Name:</td><td><input type="text" name="lastname"/></td></tr>
                    <tr><td>Email:</td><td><input type="email" name="email"/></td></tr>
                    <tr><td>Year of completion:</td><td><input type="text" name="year"/></td></tr>
                    <tr><td>Strength:</td><td><input type="text" name="strength"/></td></tr>
                    <tr><td>Notes:</td><td><textarea name="note"></textarea></td></tr>
                    <tr><td></td>
                        <td><input type="submit" value="Add"/>
                            <input type="button" value="Clear"/>
                        </td>
                    </tr>
                </form>
            </table>
            <?php if(isset($_GET['add'])):?>
            <div>Email sent to user and saved.</div>
            <?php endif;?>
        </fieldset>
<?php include_once './includes/footer.php';?>

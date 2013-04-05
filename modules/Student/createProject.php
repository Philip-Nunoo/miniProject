<?php include './includes/header.php';?>
<fieldset>
    <legend>Create New Project</legend>
    <form action="scripts/createProject.php" method="Post">
        <table>
            <tr><td>Name:</td><td><input type="text" name="name"/></td></tr>
            <tr><td>Type:</td>
                <td>
                    <select name="type">
                        <option>Mini-Project</option>
                        <option>Main Project</option>
                        <option>Personal Project</option>
                    </select>
                </td>
            </tr>
            <tr><td>Other:</td><td><input type="text" name="other" placeholder="If other specify ..."/></td></tr>
            <tr><td>Description:</td><td><textarea name="description"></textarea></td></tr>
            <tr><td></td><td><input type="Submit" value="Create Project"/></td></tr>
            <?php if($_GET['error']):?>
            <tr><td colspan="2" class="error">Please fill out form entry fields.</td></tr>
            <?php endif;?>
        </table>
    </form>
</fieldset>
<?php include './includes/footer.php';?>

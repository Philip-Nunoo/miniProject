<?php include_once './includes/header.php';?>
<?php include_once '../../bin/functions.php'; sec_session_start();?>
<form action="scripts/newMessage.php" method="post">
    <table>
        <tr><td>
                <label for="to">To: </label></td>
            <td>
                <select name="to">
                    <option value="<?php $result = getSupervisorName($_SESSION['super_id']);
                        $name = $result['firstName'] . " " . $result['lastName'];
                        echo $name;
                        ?>"> <?php echo $name;?>
                </select>
            </td>
        </tr>
        <tr><td><label for="subject">Subject: </label></td><td><input type="text" name="subject"/></td></tr>
        <tr><td><label for="message">Message: </label></td><td><textarea name="message" cols="45" rows="13"></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="Save to Draft"/><input type="submit" value ="Send Message"/></td></tr>
        <?php
            if (isset($_GET['id']) && $_GET['id'] == 0) {
                echo "<tr><td></td><td><span style=\"font-size: 10px; color: green;\">Please complete form</span></td></tr>";
            }

            if (isset($_GET['id']) && $_GET['id'] == 1) {
                echo "<tr><td></td><span style=\"font-size: 10px; color: green;\">Message Sent and saved to draft.</span></td></tr>";
            }
        ?>
    </table>
</form>

<?php include_once './includes/footer.php';?>

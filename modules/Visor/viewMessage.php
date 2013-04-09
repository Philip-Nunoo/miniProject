<?php include_once './includes/header.php';?>
<?php include_once './functions/visor_functions.php';?>
<?php 
    $message_id = $_GET['id'];
    $query = viewMessage($message_id);
    
    while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) :
?>
<p><b>Subject:</b> <?php echo $row['subject'];?></p>
<p><b>From:</b> <input text="text" value="<?php echo 'from';?>" disabled/></p>
<p><b>Message:</b> <textarea><?php echo $row['message_content'] ?></textarea></p>

<?php endwhile;?>
<?php include_once './includes/footer.php';?>


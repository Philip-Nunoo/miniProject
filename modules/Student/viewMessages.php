<?php include_once './includes/header.php';?>
<?php include_once './functions/student_functions.php';?>

<?php $results = getAllMessages(); $count = 0;?>
<table class="table" cellspacing="0">
    <tr><th></th><th></th><th>Subject</th><th>Status</th><th>Sending status</th><th>Date Created</th></tr>
<?php while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) :?>
    <tr class="row<?php echo ($count%2 == 0 ? '0' : '1');?>">
        <td><?php echo $count += 1?></td>
        <td style="text-align: left;"><input type="checkbox"/></td>
        <td><?php echo $row['subject']?></td>
        <td>
            <?php 
                if ($row['read_status'] == 0){
                    echo "Unread";
                }
            ?>
        </td>
        <td>
            <?php
                if ($row['type'] == 0){
                    echo "sent message";
                }
            ?>
        </td>
    </tr>
<?php endwhile;?>
</table>

<?php include_once './includes/footer.php';?>

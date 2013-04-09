<?php include_once './includes/header.php';?>
<?php include_once './functions/visor_functions.php';?>
<h1>All Messages</h1>
<table class="table" cellspacing="0">
    <tr style="text-align: left;"><th></th><th>Subject</th><th>Time Sent</th><th>Status</th><th>Student Name</th><th>a</th></tr>

<?php
    $query = viewAllMessages();
    $count = 0;
    while ($row = mysql_fetch_array($query, MYSQL_ASSOC)):?> 
    <tr class="row<?php echo ($count%2 == 0 ? '0' : '1');?>" style="text-align: left;">
            <td><a href=""><?php echo $count += 1?></a></td>
            <td><?php echo $row['subject']?></td>
            <td><?php echo $row['date_created']?></td>
            <td><?php echo ($row['read_status'] == 0 ? 'unread' : 'read');?></td>
            <td><?php echo "getStudentName"?></td>
            <td><a href="viewMessage.php?id=<?php echo $row['message_id'];?>">View</a> | <a href="">Delete</a> | <a href="">Reply</td>
        </tr>
<?php endwhile;?>
</table>
<?php include_once './includes/footer.php';?>

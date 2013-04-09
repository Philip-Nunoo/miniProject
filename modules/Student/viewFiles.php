<?php include_once './includes/header.php';?>
<?php include_once './functions/student_functions.php';?>
<script type="text/javascript">
    function confirm_delete() {
        return confirm("Are you sure you want to delete this file?");
    }
    
    function message(msg) {
        alert(msg);
    }
</script>
<?php 
if(isset($_GET['error'])){
    if ($_GET['error'] == 'FALSE'){
        echo '<script type="text/javascript"> message("The file has been deleted.")</script>';
    }else {
        echo "<script type='text/javascript'> message('{$_GET['error']}')</script>";
    }
}
?>
<h3>Viewing all created documents.</h3>
<p><input type="text" value="Search for file"/></p>
<?php $results = getFiles(); $count = 0;?>
<table class="table" cellspacing="0">
    <tr><th></th><th>Document Name</th><th>Date Created</th><th>Date Modified</th><th>Submission status</th><th></th></tr>
    <?php while ($result = mysql_fetch_array($results, MYSQL_ASSOC) ):?>
    <tr class="row<?php echo ($count % 2 == 0 ? '0' : '1'); ?>">
        <td><?php echo $count += 1?></td>
        <td><?php echo $result['doc_name'];?></td>
        <td><?php echo $result['date_created'];?></td>
        <td><?php echo $result['date_updated'];?></td>
        <td><?php if ($result['submission_status']=="0") { echo "Not submitted";}
                    else {echo "Submitted";}?>
        </td>
        <td><a href="viewFile.php?id=<?php echo $result['id']?>" title="View File">
                <img src="../../img/folder.png" alt="View File"/>
            </a> | 
            <a href="createFile.php?document_id=<?php echo $result['id']?>"  title="Edit File">
                <img src="../../img/edit.png" alt="Edit File"/>
            </a> | 
            <a href="scripts/deleteFile.php?id=<?php echo $result['id']?>" onclick="return confirm_delete();" title="Delete File">
                <img src="../../img/delete.png" alt="Delete File" />
            </a>
        </td>
    </tr>
    <?php endwhile;?>
</table>
<?php include_once './includes/footer.php';?>
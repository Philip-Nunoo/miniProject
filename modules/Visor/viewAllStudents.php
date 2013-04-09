<?php include_once './includes/header.php';?>
<?php include_once './functions/visor_functions.php';?>
<h1>All Students</h1>
<table class="table" cellspacing="0">
    <tr><th></th><th>Student's Name</th><th>Year</th></tr>
<?php
    $results = getStudents();
    $count = 0;
    
    while ($row = mysql_fetch_array($results)) :
?>
    <tr class="row<?php echo ($count%2 == 0 ? '0' : '1');?>">
        <td><?php echo $count += 1;?></td>
        <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
        <td>
            <?php 
                $year = 4 - ($row['year'] - date('Y'));
                if ($year > 4) {
                    echo $row['year'] - 4 . " - " . $row['year'];
                } elseif ($year < 4) {                
                    echo $year . " | continuing Student.";
                } else {
                    echo $year . " | final Year Student.";
                }
            ?>
        </td>
    </tr>
<?php endwhile;?>
</table>
<?php include_once './includes/footer.php';?>

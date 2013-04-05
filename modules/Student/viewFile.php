<?php include_once './includes/header.php';?>
<?php include_once './functions/student_functions.php';?>
<div style="background-color: white; padding: 2px 8px;">
<?php 
$result = viewFile($_GET['id']);
$result = html_entity_decode($result);
echo $result;
?>
</div>
<?php include_once './includes/footer.php';?>

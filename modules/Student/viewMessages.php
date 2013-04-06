<?php include_once './includes/header.php';?>
<?php include_once './functions/student_functions.php';?>

<?php
$results = getAllMessages();

if ($row = mysql_fetch_array($results)) {
    echo $row['date_created']."<br/>";
}
?>
<?php include_once './includes/footer.php';?>

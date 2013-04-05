<?php include_once "./includes/header.php";?>
<h2>Hello, <?php echo $firstName." ".$lastName;?></h2>
<?php $result = getProjects($_GET['id']);?>
<?php while ($result = mysql_fetch_array($result, MYSQL_ASSOC)):?>
<h3><?php echo $result['name'];?></h3>
<p><?php echo $result['description'];?></p>
<?php endwhile;?>
<div id="panel">
    <a href="" class="panel">Create Document</a>
    <a href="" class="panel">View Documents</a>
    
</div>
<?php include_once "./includes/footer.php";?>

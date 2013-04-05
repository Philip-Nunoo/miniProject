<?php include_once './includes/header.php';?>
<h1>Welcome, <?php echo $firstName." ".$lastName?></h1>
<div>
    Welcome to the online administration and management of student project work.
Here you can create new Project & Documents, Delete and Modify existing ones,
communicate with your project supervisors on the go and submit project works 
for review.
</div>
<div id="panel">
    <a href="createProject.php">
        <img src="../../img/Portfolio.png" class="panel img" alt="Start New Project"/>
    </a>
    <a href="createFile.php">
        <img src="../../img/Draft.png" class="panel img" alt="Create Document."/>
    </a>
    <a href="viewProjects.php">
        <img src="../../img/document_view.png" class="panel img" alt="View Projects."/>
    </a>
    <a href="viewDocuments.php">
        <img src="../../img/document_view.png" class="panel img" alt="View Documents."/>
    </a>
</div>
<div class="clear"></div>
<?php 
$results = getProjects();
 if (mysql_num_rows($results) != 0):?><div>
Below is a list of your current projects being worked upon.
<?php while($result = mysql_fetch_array($results, MYSQL_ASSOC)):?>
<div>
<h4><a href="project.php?id=<?php echo $result['id']?>"><?php echo $result['name'];?></a></h4>
<p><?php echo $result['description']?></p>
</div>
<?php endwhile;?>
<?php endif;?>
<?php include_once './includes/footer.php';?>

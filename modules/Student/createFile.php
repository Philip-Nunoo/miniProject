<?php include './includes/header.php';?>
<?php if(isset($_GET['document_id'])){ $document_id = $_GET['document_id'];}?>
<script type="text/javascript">
    function setDocumentName(form) {
        if(document.getElementById('document_name').value == ""){
            var document_name = prompt("Please Enter the name of your document");
            if (document_name == "" || document_name == null){
                alert("You haven't entered any name for document.");
                return false;
            } else {
                document.getElementById('document_name').value = document_name;
                return true;
            }
        } else {
            return true;
        }
    }
</script>
<form action="scripts/createFile.php" method="POST" onsubmit="return setDocumentName(this);" name="createDocumentForm" name="createDocumentForm">
<p>
    <textarea name="createForm" style="height: 800px;">
    <?php 
        if ($document_id){
            include_once '../../bin/module.php';
            echo getFileContent($document_id);           
        }
    ?>
    </textarea>
</p>
<input type="text" name="document_name" id="document_name" value="<?php if($document_id){
     include_once './functions/student_functions.php';
           echo getDocumentName($document_id);
       }?>"/>
    <?php if($document_id):?>
        <input type="hidden" name="document_id" value="<?php echo $document_id;?>"/>
    <?php endif;?>
    <input type="submit" value="Save"/>
</form>
<?php if(isset($_GET['error'])){
    if ($_GET['error']=='document_name_error'){
        echo "<div class='error'>Please enter the name of your document</div>";
    } else {
        echo "<div class='error'>Your documents seems empty</div>";
    }
}
?>
<?php 
if(isset($_GET['message'])){
    if ($_GET['message'] == 'success') {
        echo 'Document saved successfully';
    } else {
        echo 'Error while saving document.';
    }
}
?>
<script type="text/javascript" src="../../js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('createForm');
</script>
<?php include './includes/footer.php';?>
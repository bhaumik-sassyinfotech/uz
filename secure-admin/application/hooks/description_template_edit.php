<?php
session_start();
include "connection.php";
if(!isset($_SESSION['emailid']))
{ header("location: index.php");}
else
{
	if($_SESSION['isadmin']== 1)
	{header("location: dashboard.php");}
}


$you_msg="";
if (isset($_POST["btndescription"])) {	
                $description = mysqli_real_escape_string($con, $_POST['description']);
	 	$desc_qry = "UPDATE description_template SET description='".$description."' WHERE description_template_id=".$_REQUEST['desc_id'];				
		$rs2 = mysqli_query($con,$desc_qry);		
		if($rs2 == 1)
		{	$you_msg =" <br clear='all'><br clear='all'><span style='color:green;'>Successfully Saved</span>";
			
		}else{$you_msg = mysqli_error($con);}		
		
	}	 	
if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit')
{
	$desc_qry1 = "SELECT description FROM description_template where description_template_id=".$_REQUEST['desc_id'];	
	if ($result=mysqli_query($con,$desc_qry1))
	  {
		  $row =mysqli_fetch_assoc($result);
		  $description_val = $row['description'];
	  }	
} 
			
?>
<?php include "header.php";?>
<script type="text/javascript">
$(document).ready(function() { 
	$("#frmdescription").validate();
});	
</script>

<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 descptempedit">
        <h1 class="desclist"> Description Template</h1>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <span>
		 <a href="description_template.php" class="btn btn-primary descsubbtn">Add New Description Template</a>
                
          <?php echo $you_msg;?>
          </span>
          <form name="frmdescription" id="frmdescription" method="post" action="">
            <div class="form-group">
              <label for="description" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 plrsss">Description:</label>
              <textarea id="description" name="description" class="input-textarea required col-lg-12 col-md-12 col-sm-12 col-xs-12 plrsss"  cols="75" rows="5"><?php if(!empty($description_val)){echo $description_val; }?></textarea>
            </div>
            <button type="submit" class="btn btn-primary descsubbtn" name="btndescription">Save</button>
            <a href="description_template.php" class="btn btn-primary descsubbtn">Back</a>
          </form>
        </div>
		
      </div>
    </div>
  </div>
</div>

<?php include "footer.php";?>

<?php

if($_COOKIE['sid'] == null){

echo "<script>window.open('login.php','_self')</script>";

}

else {
   
?>

<div class="row" ><!-- 1  row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts -->

<ol class="breadcrumb" ><!-- breadcrumb Starts -->

<li class="active" >

<i class="fa fa-dashboard" ></i> Dashboard / Insert User

</li>



</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1  row Ends -->

<div class="row" ><!-- 2 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts -->

<div class="panel panel-default" ><!-- panel panel-default Starts -->

<div class="panel-heading" ><!-- panel-heading Starts -->

<h3 class="panel-title" >

<i class="fa fa-money fa-fw" ></i> Insert User

</h3>


</div><!-- panel-heading Ends -->


<div class="panel-body"><!-- panel-body Starts -->

<form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label">Full Name: </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<input type="text" id="admin_name" name="admin_name" class="form-control" required>

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label">Username: </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<input type="text" id="username" name="username" class="form-control" readonly>

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label">User Role: </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<select name="userrole" id="userrole">
	<option value="delivery_boy">Delivery Boy</option>
	<option value="system_manager">System Manager</option>
	<option value="super_admin">Super Admin</option>
</select>

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label">User Password: </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<input type="password" name="admin_pass" class="form-control" required>

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label">User Address: </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<input type="text" name="admin_address" class="form-control" required>

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label">User Contact: </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<input type="text" name="admin_contact" class="form-control" required>

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label">User Image: </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<input type="file" name="admin_image" class="form-control" required>

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"></label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<input type="submit" name="submit" value="Insert User" class="btn btn-primary form-control">

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->


</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
	$("#admin_name").change(function() {
		var nm = $("#admin_name").val().split(" ")
		var unm = nm[0]
		for(let i=1;i<nm.length;i++)
		{
			unm += nm[i].substr(0,1)
		}
		unm += "_admin"

		$.ajax({
			url:"api/getusernames.php",
			type:"POST",
			success:function(para)
			{
				unm += "_"+para
				$("#username").val(unm)
			}
		})


	})
</script>

</div><!-- 2 row Ends -->

<?php
require_once('includes/db.php');

if(isset($_POST['submit'])){

$admin_name = $_POST['admin_name'];

$username = $_POST['username'];

$admin_pass = $_POST['admin_pass'];

$admin_address = $_POST['admin_address'];

$admin_contact = $_POST['admin_contact'];

$admin_role = $_POST['userrole'];

$admin_image = $_FILES['admin_image']['name'];

$temp_admin_image = $_FILES['admin_image']['tmp_name'];

move_uploaded_file($temp_admin_image,"admin_images/$admin_image");

$insert_admin = "insert into admins (admin_name,admin_email,admin_pass,admin_image,admin_contact,admin_address,admin_role) values ('$admin_name','$username','$admin_pass','$admin_image','$admin_contact','$admin_address','$admin_role')";

$run_admin = mysqli_query($con,$insert_admin);


if($run_admin){

echo "<script>alert('One User Has Been Inserted successfully')</script>";

echo "<script>window.open('index.php?view_users','_self')</script>";

}else {
	echo "Error: " . $sql . "" . mysqli_error($con);
 }


}


?>



<?php }  ?>

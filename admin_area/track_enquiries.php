<?php
if($_COOKIE['sid'] == null){

echo "<script>window.open('login.php','_self')</script>";

}

else {
  $get_boys = "SELECT admin_name,admin_id FROM admins where admin_role='delivery_boy'";
  $run_boy = mysqli_query($con,$get_boys);
  $run_boy1 = mysqli_query($con,$get_boys);
?>

<style>
.unstyled-button {
  border: none;
  padding: 0;
  background: none;
}
</style>


<!-- Modal Start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label>Delivery Boy</label>
        <select  name="boy_name" id="boy_name">
      <?php 
        while($boy1 = mysqli_fetch_array($run_boy1)){
          $namee=$boy1['admin_name'];
          $boy_id=$boy1['admin_id'];

          echo "<option value='$boy_id'>" .$namee . "</option>";
          }
      ?>
      <label>Time and Date</label>
      <input type="date" placeholder="Enter Date " id="boy_date" name="boy_date">
      <input type="time" placeholder="Enter Date " id="boy_time" name="boy_time">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="" name="quotes" class="btn btn-primary" onclick="updateModal(this.id)">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal End -->


<!-- Modal Start-->
<div class="modal fade" id="exModal" tabindex="-1" role="dialog" aria-labelledby="exModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Total Cost for Repairing (₹) *<input type="text" placeholder="Enter Amount in ₹ " id="price">
        Additional Note (if any)<input type="text" placeholder="Enter Note " id="note">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="" name="temp" class="btn btn-primary" onclick="updateprice(this.id)">Update Price</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal End -->


<!-- Modal Start-->
<div class="modal fade" id="eModal" tabindex="-1" role="dialog" aria-labelledby="eModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label>Delivery Boy</label>
        <select  name="boy_name" id="boy_name">
      <?php 
        while($boy = mysqli_fetch_array($run_boy)){
          $namee=$boy['admin_name'];
          $boy_id=$boy['admin_id'];

          echo "<option value='$boy_id'>" .$namee . "</option>";
          }
      ?>
      <label>Time and Date</label>
      <input type="date" placeholder="Enter Date " id="boy_date" name="boy_date">
      <input type="time" placeholder="Enter Date " id="boy_time" name="boy_time">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="" name="temp1" class="btn btn-primary" onclick="deliveryupdateModal(this.id)">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal End -->


<div class="row" ><!-- 1 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts -->

<ol class="breadcrumb" ><!-- breadcrumb Starts -->

<li class="active" >

<i class="fa fa-dashboard" ></i> Dashboard / Track Enquiries
</li>

</ol><!-- breadcrumb Ends -->


</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->


<div class="row" ><!-- 2 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts -->

<div class="panel panel-default" ><!-- panel panel-default Starts -->

<div class="panel-heading" ><!-- panel-heading Starts -->

<h3 class="panel-title" ><!-- panel-title Starts -->

<i class="fa fa-money fa-fw" ></i> Track Enquiries

</h3><!-- panel-title Ends -->


</div><!-- panel-heading Ends -->

<div class="panel-body" ><!-- panel-body Starts -->

<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>
<th>Request</th>

<th>User Name </th>

<th>User Contact </th>

<th>Delivery Person</th>

<th>Date</th>

<th>Time </th>

<th>Status</th>

<th>Action</th>

<th>Confirm Price</th>





</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<?php


$get_enquiries = "SELECT * FROM scheduled_request 
                  inner join admins on admins.admin_id=scheduled_request.admin_id 
                  inner join req on req.rid=scheduled_request.rid 
                  inner join users on req.uid=users.uid
                  where req.status>0";

$run_admin = mysqli_query($con,$get_enquiries);

while($row_admin = mysqli_fetch_array($run_admin)){

$run_q = mysqli_query($con,$admin);

$rid = $row_admin['rid'];
    
$date = $row_admin['date'];

$time = $row_admin['time'];

$username = $row_admin['username'];

$phonenum = $row_admin['phonenum'];

$devliveryboy = $row_admin['admin_name'];

$statuss= $row_admin['status'];
if($statuss=="1"){
  $statuss="Delivery Boy assigned";
}
if($statuss=="2"){
  $statuss="Phone picked up from user";
}
if($statuss=="3"){
  $statuss="Phone dropped to admin";
}
if($statuss=="4"){
  $statuss="Price Updated";
}
if($statuss=="7"){
  $statuss="Price accepted by user";
}
if($statuss=="8"){
  $statuss="Person assigned for delivery";
}
if($statuss=="9"){
  $statuss="Phone dropped to customer";
}
$disabled = $statuss != "Phone dropped to admin"?"disabled" : "";

?>

<tr>

<td><?php echo $rid; ?></td>
<td><?php echo $username; ?></td>
<td><?php echo $phonenum; ?></td>
<td><input type="button" id="<?php echo $rid; ?>" name="assign" value="<?php echo $devliveryboy; ?>"  class="unstyled-button" data-toggle="modal" data-target="#eModal" onclick="deliverymodaldata(this.id)"></td>
<td><?php echo $date; ?></td>
<td><?php echo $time; ?></td>

<td><?php echo $statuss; ?></td>

<td><input type="button" id="<?php echo $rid; ?>" name="assign" value="Update" class="btn btn-primary form-control" data-toggle="modal" data-target="#exampleModal" onclick="modaldata(this.id)"></td>


<td><input type="button" id="<?php echo $rid; ?>"  name="pricing" value="Pricing" class="btn btn-primary form-control" data-toggle="modal" data-target="#exModal" <?php echo $disabled; ?> onclick="pricemodaldata(this.id)" ></td>

</tr>


<?php } ?>

</tbody><!-- tbody Ends -->



</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->


</div><!-- panel-body Ends -->


</div><!-- panel panel-default Ends -->


</div><!-- col-lg-12 Ends -->



</div><!-- 2 row Ends -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    function pricemodaldata(rid)
    {
        $("#exModalLabel").empty()
        $("#exModalLabel").append("Assign Delivery boy for Request No: "+rid)
        $('[name="temp"]').attr("id",rid)
        $.ajax({
        url:"api/getprice.php",
        data:{"rid":rid},
        success:function(para)
        {
            console.log(para);
            para = JSON.parse(para)
            $("#price").val(para[0])
            $("#note").val(para[2])
            if(para[1]!="0"){
              $("#price").val(para[1])
            }
            
            
        }
    })
    }

    function updateprice(rid)
    {
        $.ajax({
        url:"api/updateprice.php",
        type:"POST",
        data:{"rid":rid , "price":$("#price").val() , "note":$("#note").val()},
        success:function(para)
        {
            if(para == "success")
            {
                alert("Updated Successfully")
                window.setTimeout(function(){location.reload()},1000)
            }
            else
            {
                alert(para)
                
            }
        }
    })
    }
    function deliverymodaldata(rid)
    {
        $("#eModalLabel").empty()
        $("#eModalLabel").append("Update Delivery boy for Request No: "+rid)
        $('[name="temp1"]').attr("id",rid)
    }
    function modaldata(rid)
    {
        $("#exampleModalLabel").empty()
        $("#exampleModalLabel").append("Assign Delivery boy for Request No: "+rid)
        $('[name="quotes"]').attr("id",rid)
    }
    function deliveryupdateModal(rid)
    {
        $.ajax({
        url:"api/updatename.php",
        type:"POST",
        data:{"rid":rid , "boy_date":$("#boy_date").val() ,"boy_name":$("#boy_name").val() , "boy_time":$("#boy_time").val()},
        success:function(para)
        {
            if(para=='success')
            {
                alert("Updated")
                window.setTimeout(function(){location.reload()},1000)
            }else{
              alert(para)
                window.setTimeout(function(){location.reload()},1000)
            }
            
        }
    })
    }
    function updateModal(rid)
    {
        $.ajax({
        url:"api/updatedeliveryboy.php",
        type:"POST",
        data:{"rid":rid , "boy_date":$("#boy_date").val() ,"boy_name":$("#boy_name").val() , "boy_time":$("#boy_time").val()},
        success:function(para)
        {
            if(para=='success')
            {
                alert("Updated")
                window.setTimeout(function(){location.reload()},1000)
            }else{
              alert(para)
                window.setTimeout(function(){location.reload()},1000)
            }
            
        }
    })
    }
</script>



<?php }  ?>
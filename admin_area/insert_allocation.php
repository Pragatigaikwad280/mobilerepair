<div class="row" ><!-- 1  row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts -->

<ol class="breadcrumb" ><!-- breadcrumb Starts -->

<li class="active" >

<i class="fa fa-dashboard" ></i> Dashboard / New Allocation

</li>



</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1  row Ends -->

<div class="row" ><!-- 2 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts -->

<div class="panel panel-default" ><!-- panel panel-default Starts -->

<div class="panel-heading" ><!-- panel-heading Starts -->

<h3 class="panel-title" >

<i class="fa fa-money fa-fw" ></i> Create New Allocation

</h3>


</div><!-- panel-heading Ends -->


<div class="panel-body"><!-- panel-body Starts -->

<!-- Form Start -->

<form method="post" enctype="multipart/form-data" id="allocation">
    <div class="form-container">
        <p class="includedet">Please Enter All Details</p><br>

        <table class="table">
            <tr>
                <th>Select Mobile Model</th>
                <th>Select Sub Problem</th>
                <th>Enter Pricing Details</th>
            </tr>
            <tr>
                <td>
                    <select name="models1" id="models1">
                    </select>
                </td>
                <td>
                    <select name="subproblems1" id="subproblems1">
                    </select>
                </td>
                <td>
                    <input type="text" id="price1" name="price1" placeholder="Enter Price *" onfocus="addAllocation()">
                </td>
            </tr>
        </table>
        
        
        
        <div id="adetails"> </div>

        <button class="form-btn" id="submit">Submit</button>
    </div>
    
</form>

<!-- Form End -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   
<script>
$(document).ready(function(){

    $.ajax({
        url:"api/getmodels.php",
        type:"POST",
        success:function(para)
        {
            para = JSON.parse(para)
            window.models = para
            for(let i=0;i<para.length;i++)
            {
                var str = '<option value="'+para[i][1]+'">'+para[i][0]+'</option>'
                $("#models1").append(str)
            }
        }
    })

    $.ajax({
        url:"api/getsubproblems.php",
        type:"POST",
        success:function(para)
        {
            para = JSON.parse(para)
            window.subproblems = para
            for(let i=0;i<para.length;i++)
            {
                var str = '<option value="'+para[i][1]+'">'+para[i][0]+'</option>'
                $("#subproblems1").append(str)
            }
        }
    })
})
var ctr = 2
function addAllocation()
{
    var s = '<tr><td><select name="models'+ctr+'" id="models'+ctr+'"></select></td><td><select name="subproblems'+ctr+'" id="subproblems'+ctr+'"></select></td><td><input type="text" id="price'+ctr+'" name="price'+ctr+'" placeholder="Enter Price *" onfocus="addAllocation()"></td></tr>'
    $(".table").append(s)
    for(let i=0;i<window.models.length;i++)
    {
        var str = '<option value="'+window.models[i][1]+'">'+window.models[i][0]+'</option>'
        $("#models"+ctr).append(str)
    }
    for(let i=0;i<window.subproblems.length;i++)
    {
        var str = '<option value="'+window.subproblems[i][1]+'">'+window.subproblems[i][0]+'</option>'
        $("#subproblems"+ctr).append(str)
    }
    ctr+=1
}


function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    var cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        
        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
    return null;
}


var sid = getCookie("sid");
console.log(sid)
if(sid==null)
{
  window.location.replace('./')
}

$("#submit").click(function() {

    var arr=[]
    arr[0]= [$('#models1').val(),$('#subproblems1').val(),$('#price1').val()]
    for(let i =1;i<ctr;i++)
    {
        var x = '#models'+(i+1)
        var y = '#subproblems'+(i+1)
        var z = '#price'+(i+1)

        if($(x).val() != "" && $(x).val() != undefined && $(y).val() != "" && $(y).val() != undefined && $(z).val() != "" && $(z).val() != undefined)
        {
            arr.push([$(x).val(),$(y).val(),$(z).val()])
        }
    }
    console.log(arr)
    alert(arr)
$.ajax({
  url: './api/submitallocation.php',
  type: 'POST',
  data: {"allocations":arr},
  success: function(response){

    if(response != "400")
    {
      alert("Allocation Done Successfully")
      window.open('index.php?view_allocation','_self');

    }
  }
})
return false;
});  
</script>

</div><!-- 2 row Ends -->

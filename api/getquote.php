<?php
error_reporting(0);
if(isset($_POST))
{
    require_once("../includes/db.php");
    $rid = $_POST['rid'];
    $sql = "SELECT estprice,note FROM req WHERE rid=1";
    $res = mysqli_query($con,$sql);
    $price=$res['estprice'];
    $note=$res['note'];
    echo json_encode(array($price, $note));
}
?>
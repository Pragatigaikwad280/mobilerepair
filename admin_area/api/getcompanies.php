<?php

error_reporting(0);
if(isset($_POST))
{
    require('../includes/db.php');
    $sql = 'SELECT mcname,mcid FROM mobilecompany';
    $result = mysqli_query($con, $sql);

    $arr = [];
    
    if (mysqli_num_rows($result) > 0) 
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            array_push($arr,[$row['mcname'],$row['mcid']]);
        }
    }

    echo json_encode($arr);
}

?>
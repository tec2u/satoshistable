<?php

error_reporting(E_ERROR | E_PARSE);
include "../config.php";


$query2 = "SELECT * FROM users ";
$result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
while($refaz=mysqli_fetch_array($result2)){
####GLOBAL
$debug_mode="on";
$usuario=$refaz['id'];



$esquerda=mysqli_fetch_array(mysqli_query($con,"select sum(score) as total from historic_score where user_id = '".$usuario."' and leg='L' and status=1 "));
$direita=mysqli_fetch_array(mysqli_query($con,"select sum(score) as total from historic_score where user_id = '".$usuario."' and leg='R' and status=1 "));

if($esquerda['total']==0 or $esquerda['total']==null){$esquerda['total']=0;}
if($direita['total']==0 or $direita['total']==null){$direita['total']=0;}

echo $sql = "update users SET  qty_total_left='$esquerda[total]' ,qty_total_right='$direita[total]' where id='$usuario' ;";

echo "</br>";

  //  $query = mysqli_query($con,$sql)or die(mysqli_error($con));


}




?>

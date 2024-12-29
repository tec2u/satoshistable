<?php
error_reporting(E_ERROR | E_PARSE);



$data_atual = date('Y-m');
$data1= date('Y-m');
$data2= date('Y-m-d');


$while_pedidos = mysqli_query($con,"SELECT id,price,user_id,subscription_id FROM orders_package where status=1 and price>=100 and package_id not in (9,10)");###pacotes free

while($pedidos_users = mysqli_fetch_array($while_pedidos))
{
	$multiplicador=0;
	$total=$pedidos_users['price'];
	$usuario=$pedidos_users['user_id'];

	if($total<=1999 and $pedidos_users['subscription_id']!=1){ $multiplicador=0.1; }
	if($total<=1999 and $pedidos_users['subscription_id']==1){ $multiplicador=0.17; }
	if($total>=2000 and $pedidos_users['subscription_id']!=1){ $multiplicador=0.12; }
	if($total>=2000 and $pedidos_users['subscription_id']==1){ $multiplicador=0.20; }

	$energy_price=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM energy_price order by id desc limit 1"));

	
	$calc1 = $pedidos_users['price']*$multiplicador; ###Quanto ganha no mes
	$calc2 = $calc1/30; ###Quanto ganha no dia
	$calc3 = $calc2/$energy_price['price']; ###Conversao em energia


	echo "TOTAL BONUS:".ChecaTotalBonus($con,$usuario)." --- OVERALL PACK:".ChecaTotalPedido($con,$usuario)." --- PACKAGE: $total ---- ";

	if((ChecaTotalBonus($con,$usuario)<=(ChecaTotalPedido($con,$usuario)*3))){####MAX QUE PODE RECEBER É 3x

	$user = mysqli_fetch_array(mysqli_query($con,"SELECT login FROM users where id='$pedidos_users[user_id]'"));###pacotes free


	//echo "$calc1 = $pedidos_users[price]*$multiplicador; </br> $calc2 = $calc1/30; </br> $calc3 = $calc2/$energy_price[price] </br> SUBSCRIPTION: $pedidos_users[subscription_id]</br></br>";
	//echo "Insert into daily_percentage set value_perc='$calc3', user_id='$pedidos_users[user_id]', status=1,created_at='".date('Y-m-d H:i:s')."',updated_at='".date('Y-m-d H:i:s')."'</br></br></br>";
	//mysqli_query($con,"Insert into daily_percentage set value_perc='$calc3', user_id='$pedidos_users[user_id]', status=1,created_at='".date('Y-m-d H:i:s')."',updated_at='".date('Y-m-d H:i:s')."'");
	
	echo "LOGIN:$user[login] ---- TOTAL DAILY:$calc3 ---- %:".($multiplicador*100)."% </br>";


	}


	########SE CADA PEDIDO TIVER UM TEMPO DIFERENTE, UM É UM ANO OUTRO 1 MES, NAO POSSO SOMAR TUDO

}






?>
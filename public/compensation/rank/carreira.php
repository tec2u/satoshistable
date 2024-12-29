<?php
error_reporting(E_ERROR | E_PARSE);

$data_atual = date('Y-m');
$data1= date('Y-m');
$data2= date('Y-m-d');


$while_carreiras = mysqli_query($con,"SELECT id FROM users where qty_total_left>0 and qty_total_right>0");

while($carreira_users = mysqli_fetch_array($while_carreiras))
{GeraCarreira($carreira_users['id'],$con,$data1,$data2);}







##############################################
function GeraCarreira($user_id,$con,$data1,$data2){
	
	echo "</br></br>##########################LOG CAREER $user_id############################### </br></br>";
		
	$data_atual = $data1;
	$logado = $user_id;
	$id_logado = $user_id;
	$directs=0;

	$user = mysqli_fetch_array(mysqli_query($con,"SELECT login FROM users where id='$user_id'"));

	$minha_pontuacao1 = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(score) as pontos_ac_m 
	FROM historic_score WHERE user_id = '{$id_logado}' and leg='L' and
	orders_package_id>=0 and description=7"));
	$minha_pontuacao = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(score) as pontos_ac_m 
	FROM historic_score WHERE user_id = '{$id_logado}' and leg='R' and
	orders_package_id>=0 and description=7"));


	//echo "PONTOS PESSOAIS:".$minha_pontuacao['pontos_ac_m']." </br></br>";
	
  
	$carreira_atual = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM career_users WHERE user_id = '{$id_logado}' and created_at like '%$data_atual%' ORDER BY career_id DESC LIMIT 1 "));
	if ($carreira_atual['career_id'] == null) {
		$ordem = 1;
	}else{
		$ordem = $carreira_atual['career_id'] + 1;
	}

	$carreiras = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM career WHERE id = '{$ordem}' "));


	//echo "PROXIMA CARREIA: ".$carreiras['name']." REQUIREMENTS-->: ".$carreiras['score']." -- MIN_Directs: ".$carreiras['directs']." -- Bonus: ".$carreiras['bonus']." --  </br>";

	if ($carreiras['id'] == null) {

	}else{


	
	$meus_pontos=$minha_pontuacao['pontos_ac_m'];
	$meus_pontos1=$minha_pontuacao1['pontos_ac_m'];
		
	
	echo "USER:$user[login]  L: $meus_pontos1 --- R: $meus_pontos </br>";

	/*  echo "VALOR FINAL DOS USUARIOS:$sum, MEUS PONTOS:$meus_pontos, SOMA TOTAL: ".$soma;
	echo "<br></br>";
	echo "TOTAL DIRETOS : ".$cont;
	echo "<br></br>";  */
	$data = date($data2.' 23:59:59');
	//echo "VALOR TOTAL VOLUME: ".$directs." ";
	 
	if ($_SESSION['bloqueia_cron'] == '') {

	if ($meus_pontos >= $carreiras['score'] and $meus_pontos1 >= $carreiras['score']) {
		//echo "Você atingiu a carreira ".$carreiras['name'];
		echo "INSERIU  $carreiras[name]</br>";
		//$insere_carreira = mysqli_query($con,"INSERT INTO career_users SET user_id = '{$id_logado}', career_id = '{$ordem}', created_at = '{$data}' , updated_at = '{$data}'  ") or die(mysql_error());
		//$_SESSION['bloqueia_cron'] = 'bloqueado';
		
		

		
		
		
		
			
			
		
		
	}else{
		echo "Opss .. não foi possivel atingir esta carreira!!! ".$carreiras['name'];
	}

	}else{
	}

	}
}





?>
<?php
error_reporting(E_ERROR | E_PARSE);

include "../config.php";

$data_atual = date('Y-m');
$data1= date('Y-m');
$data2= date('Y-m-d');


$while_carreiras = mysqli_query($con,"SELECT id FROM users");

while($carreira_users = mysqli_fetch_array($while_carreiras))
{GeraCarreira($carreira_users['id'],$con,$data1,$data2);}







##############################################
function GeraCarreira($user_id,$con,$data1,$data2){
	
	echo "</br></br>##########################LOG CAREER $user_id############################### </br></br>";
		
	$data_atual = $data1;
	$logado = $user_id;
	$id_logado = $user_id;
	$directs=0;


	$minha_pontuacao = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(score) as pontos_ac_m FROM historic_score WHERE user_id = '{$id_logado}' AND created_at LIKE '%{$data_atual}%' and
	level_from=0 and description=8"));


	echo "PONTOS PESSOAIS:".$minha_pontuacao['pontos_ac_m']." </br></br>";
	$meus_pontos = $minha_pontuacao['pontos_ac_m']+$PersonalVolumeExternal['total'];
  
	$carreira_atual = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM career_users WHERE user_id = '{$id_logado}' and created_at like '%$data_atual%' ORDER BY career_id DESC LIMIT 1 "));
	if ($carreira_atual['career_id'] == null) {
		$ordem = 1;
	}else{
		$ordem = $carreira_atual['career_id'] + 1;
	}

	$carreiras = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM career WHERE id = '{$ordem}' "));


	echo "PROXIMA CARREIA: ".$carreiras['name']." REQUIREMENTS-->: ".$carreiras['score']." -- MIN_Directs: ".$carreiras['directs']." -- Bonus: ".$carreiras['bonus']." --  </br>";

	if ($carreiras['id'] == null) {

	}else{

	//$verifica_diretos = mysqli_query($con,"SELECT * FROM users WHERE recommendation_user_id = '{$logado}' ");

	$verifica_pontuacao = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(score) as pontos_ac FROM historic_score WHERE user_id = '{$id_logado}' and description=8 "));

	echo "PONTOS TOTAL:$verifica_pontuacao[pontos_ac] </br>";
	$meus_pontos=$verifica_pontuacao['pontos_ac'];
		/* while ($array_verifica_diretos = mysqli_fetch_array($verifica_diretos)) {

			$id_indi_diretos = $array_verifica_diretos['id'];
			$verifica_pontuacao_rede = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(score) as pontos_ac FROM historic_score WHERE user_id = '{$id_indi_diretos}' AND created_at LIKE '%{$data_atual}%' and description=8 "));

				echo "SELECT SUM(score) as pontos_ac FROM historic_score WHERE user_id = '{$id_indi_diretos}' AND created_at LIKE '%{$data_atual}%' AND description=8 ";
				echo "</br>";
				
				if ($verifica_pontuacao_rede['pontos_ac'] >= $carreiras['score']) {
					$valor_aproveitado = $carreiras['score'];
				}else{
					$valor_aproveitado = $verifica_pontuacao_rede['pontos_ac'];
				}
				
				#####SE ELE TIVER MAIS PONTOS QUE O 'BONUS' QUE É O MINIMO POR REDE CONTA +DIRECT
				if($carreiras['bonus']<=$verifica_pontuacao_rede['pontos_ac']){$directs++;}
				
				echo "LOGIN: ".$array_verifica_diretos['login']." ID: $array_verifica_diretos[id]";
				echo "</br>";
				echo "TOTAL PONTOS: ".$verifica_pontuacao_rede['pontos_ac'];
				echo "</br>";
				echo "VALUE AFTER MVL: ".$valor_aproveitado;
				echo "</br>";
				echo "</br>";
				
			$sum += $valor_aproveitado;

			$conta ++;
		} */
	/* if($meus_pontos>$carreiras['score'] and $carreiras['id']!=1 and $carreiras['id']!=2){$meus_pontos=$carreiras['score'];}####APLICA MVR NOS PONTOS PESSOAIS */
	$cont = $conta;
	$soma = $sum + $meus_pontos;
	 echo "VALOR FINAL DOS USUARIOS:$sum, MEUS PONTOS:$meus_pontos, SOMA TOTAL: ".$soma;
	echo "<br></br>";
	echo "TOTAL DIRETOS : ".$cont;
	echo "<br></br>"; 
	$data = date($data2.' 23:59:59');
	echo "VALOR TOTAL VOLUME: ".$directs." ";
	 
	if ($_SESSION['bloqueia_cron'] == '') {

	if ($soma >= $carreiras['score']) {
		echo "Você atingiu a carreira ".$carreiras['name'];
		echo "INSERT INTO career_users SET user_id = '{$id_logado}', career_id = '{$ordem}', created_at = '{$data}' , updated_at = '{$data}'  ";
		$insere_carreira = mysqli_query($con,"INSERT INTO career_users SET user_id = '{$id_logado}', career_id = '{$ordem}', created_at = '{$data}' , updated_at = '{$data}'  ") or die(mysql_error());
		//$_SESSION['bloqueia_cron'] = 'bloqueado';
		$men = "Você atingiu a carreira ".$carreiras['name'];
		

		
		
			
			
		
		
	}else{
		echo "Opss .. não foi possivel atingir esta carreira!!! ".$carreiras['name'];
	}

	}else{
	}

	}
}





?>
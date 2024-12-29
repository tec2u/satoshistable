<?php

	error_reporting(E_ALL);
	include "config.php";

	 if($_POST['type']=="Bonificacao" and $_POST['idpedido']>0){
		
		$order_id=$_POST['idpedido'];

		$p=mysqli_fetch_array(mysqli_query($con,"select * from orders_package where id=$order_id"));
		if($p['package_id']==1){$type=2;}###Mensal
		if($p['package_id']!=1){$type=1;}###Indicacao Direta nos nao mensal

		echo "</br>ok---Bonificacao Entrou $p[id]";
		if($type==1){
		include "binario/SobePontos.php";###SOBE PONTUACAO BINARIA COM A PERNA CORRETA
		}
		echo "</br>ok---Unilevel  $p[id]";
		include "unilevel/SobePontos.php";###SOBE PONTUACAO UNILEVEL PELO PATROCINADOR
		
			
	   }
	   if($_POST['type']=="CadastroBinario" and $_POST['user_id']>0){
		
		$id_comprador=$_POST['user_id'];
		include "binario/contagem_binaria.php";###POSICIONAMENTO	
			
	   }
	   if($_POST['type']=="rank"){
		
		
		
			include "rank/carreira.php";###SOBE PONTUACAO BINARIA COM A PERNA CORRETA
	   }


	   if($_POST['type']=="CompensacaoBinaria"){
		
			include "binario/Compensacao.php"; ####COMPENSA OS 2 LADOS
  		}


		if($_POST['type']=="DailyEnergy"){
				
			include "diario/bonus_diario.php"; ####COMPENSA OS 2 LADOS
		} 

	//$sql = mysqli_query($con, "select * from users order by id desc limit 1");

	//$get_change = mysqli_fetch_array($sql);
	
	####CONTA A REDE
	
	//include "binario/rede2.php";###VISUALIZAR BINARIO
	//include "binario/count_rede.php"; ###TOTAL DE USUARIOS DE CADA LADO
	
	function ChecaExistePonto($con,$order_id,$usuario,$description){


		$sql = "select * from  historic_score where   user_id='$usuario' and description='$description' and orders_package_id=$order_id ";
		$query = mysqli_num_rows(mysqli_query($con,$sql));
	
		if($query>0){return 1;}else{return 0;}
		
	
	
	}
	
	function ChecaPerna($con,$user_id){
	
		echo $sql = "select * from  binary_network where r_u='$user_id' or l_u='$user_id' ";
		$query = mysqli_fetch_array(mysqli_query($con,$sql));
		if($query['r_u']==$user_id){return 'R';}
		if($query['l_u']==$user_id){return 'L';}
	}
	

	function ChecaTotalPedido($con,$usuario){


		$sql = "select sum(price) as total from  orders_package where   user_id='$usuario' and status=1";
		$puxaTotal = mysqli_fetch_array(mysqli_query($con,$sql));
	
		return $puxaTotal['total'];
		
	
	
	}
	
	function ChecaTotalBonus($con,$usuario){
	
	
		$sql = "select sum(price) as total from  banco where   user_id='$usuario'";
		$puxaTotal = mysqli_fetch_array(mysqli_query($con,$sql));
	
		return $puxaTotal['total'];
		
	
	
	}
	?>



<?php

// GLOBALS
$debug_mode = "on";

// Insere uma linha em branco para o novo usuário (mantendo a instrução original)
$sql1 = "INSERT INTO binary_network SET user_id = '" . $id_comprador . "' ";
$query1 = mysqli_query($con, $sql1);

// Verifica se o usuário já está posicionado na rede binária
$check_posicionado = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM binary_network WHERE l_u='" . $id_comprador . "' OR r_u='" . $id_comprador . "'"));
if (empty($check_posicionado['id'])) {

	if ($debug_mode == "on") {
		echo "BINARIO - VAR LOGIN:" . $id_comprador . "</br>";
	}

	// Obtém informações do patrocinador
	$patro1 = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id='" . $id_comprador . "'"));
	$ii = $patro1['recommendation_user_id'];
	$titan = $ii;

	if ($debug_mode == "on") {
		echo "select * from users where id='" . $ii . "'</br>";
	}

	$patro = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE id='" . $ii . "'"));

	// Determina a perna do patrocinador (removendo código comentado desnecessário)
	if ($patro['perna_cad'] == "B") {
		// Calcula o tamanho das redes direita e esquerda (assumindo que a função count_rede.php está correta)
		$user_id_rede = $ii;
		include "/compensation/binario/count_rede.php";

		// Define a perna do patrocinador com base no tamanho das redes
		$patro['perna_cad'] = ($direita_rede == $esquerda_rede) ? "L" : (($direita_rede > $esquerda_rede) ? "L" : "R");
	}

	if ($debug_mode == "on") {
		echo "PATRO PERNA:" . $patro['perna_cad'] . "</br>";
	}

	// Posiciona o usuário na rede binária
	if ($patro['perna_cad'] == "R") {
		$vazio = 0;
		while ($vazio != 1) {
			if ($debug_mode == "on") {
				echo "select * from binary_network where user_id = '" . $titan . "' </br>";
			}
			$s = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM binary_network WHERE user_id = '" . $titan . "' "));
			if (empty($s['r_u'])) {
				$patrocinador = $titan;
				$vazio = 1;

				$sql = "UPDATE binary_network SET r_u = '$id_comprador' WHERE user_id = '" . $patrocinador . "'";
				if ($debug_mode == "on") {
					echo "$sql </br>";
				}
				mysqli_query($con, $sql);
			} else {
				$titan = $s['r_u'];
			}
		}
	} elseif ($patro['perna_cad'] == "L") {
		$vazio = 0;
		while ($vazio != 1) {
			if ($debug_mode == "on") {
				echo "PATROCINADOR: $patrocinador, TITAN: $titan</br>";
			}
			$s = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM binary_network WHERE user_id = '" . $titan . "' "));
			if (empty($s['l_u'])) {
				$patrocinador = $titan;
				$vazio = 1;

				$sql = "UPDATE binary_network SET l_u = '$id_comprador' WHERE user_id = '" . $patrocinador . "'";
				if ($debug_mode == "on") {
					echo "$sql </br>";
				}
				mysqli_query($con, $sql);
			} else {
				$titan = $s['l_u'];
			}
		}
	}
}

?>
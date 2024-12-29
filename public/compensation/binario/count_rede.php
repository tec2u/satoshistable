<?php

$user_id_rede = 1;

/*************************INCLUI ARQUIVOS*************************/

$s1_rede = mysqli_query($con, "SELECT l_u, r_u FROM binary_network WHERE user_id = '$user_id_rede'");
$s2_rede = mysqli_fetch_array($s1_rede);

/*************************ESQUERDA*************************/

$esquerda_rede = count_rede_lado($con, $s2_rede['l_u']);

/*************************DIREITA*************************/

$direita_rede = count_rede_lado($con, $s2_rede['r_u']);

/*************************FIM CONTA*************************/

echo $esquerda_rede . "---" . $direita_rede;

/*************************FUNÇÃO AUXILIAR*************************/

function count_rede_lado($con, $user_id)
{
	$array_rede = array($user_id);
	$go_rede = 1;

	while ($go_rede == 1) {
		$array_rede = array_unique($array_rede);
		$d1 = count($array_rede);

		$new_users = array();
		foreach ($array_rede as $value_rede) {
			if ($value_rede != "") {
				$sql1_rede = mysqli_query($con, "SELECT l_u, r_u FROM binary_network WHERE user_id = '$value_rede'");
				$x_rede = mysqli_fetch_array($sql1_rede);

				if ($x_rede['l_u'] != "") {
					$new_users[] = $x_rede['l_u'];
				}
				if ($x_rede['r_u'] != "") {
					$new_users[] = $x_rede['r_u'];
				}
			}
		}

		$array_rede = array_merge($array_rede, $new_users);
		$d2 = count($array_rede);

		if ($d1 == $d2) {
			$go_rede = 0;
		}
	}

	$array_rede = array_unique($array_rede);
	$count = count($array_rede);

	return ($array_rede[0] == "" && $count == 1) ? 0 : $count;
}

?>
<?php



####GLOBAL
$debug_mode = "on";



$while_carreiras = mysqli_query($con, "SELECT id FROM users");

while ($carreira_users = mysqli_fetch_array($while_carreiras)) {

    $level_from = 0;
    $vazio = 0;
    $usuario = $carreira_users['id'];


    $esquerda = mysqli_fetch_array(mysqli_query($con, "select sum(score) as total from historic_score where user_id = '" . $usuario . "' and leg='L' and status=1 "));
    $direita = mysqli_fetch_array(mysqli_query($con, "select sum(score) as total from historic_score where user_id = '" . $usuario . "' and leg='R' and status=1 "));

    if ($esquerda['total'] > 0 and $direita['total'] > 0) {

        if ($esquerda['total'] >= $direita['total']) {

            $total = $esquerda['total'] - $direita['total'];
            $resto = 'L';
            $retirado = $direita['total'];
        } else {

            $total = $direita['total'] - $esquerda['total'];
            $resto = 'R';
            $retirado = $esquerda['total'];
        }

        $banco_final = $retirado * 0.1;

        ####INSERE NO BANCO
        if ((ChecaTotalBonus($con, $usuario) <= (ChecaTotalPedido($con, $usuario) * 3))) { ####MAX QUE PODE RECEBER É 3x

            $user = mysqli_fetch_array(mysqli_query($con, "SELECT login FROM users where id='$usuario'"));

            echo "LOGIN: $user[login]  ---- TOTAL LEFT: $esquerda[total] - TOTAL RIGHT: $direita[total] ---   BINARIO PAYMENT:$ $banco_final ---- BIGLEG:$resto ---- BIGLEG TOTAL REST:$total </br>";

            $sql = "INSERT INTO banco SET  price = '$banco_final', user_id='$usuario',description='1',order_id=0,
            level_from=0, created_at='" . date('Y-m-d H:i:s') . "',updated_at='" . date('Y-m-d H:i:s') . "' ";

            $query = mysqli_query($con, $sql) or die(mysqli_error($con));
            unset($sql);
            //}
            #####INUTILIZA OS PONTOS

            $sql = "update historic_score SET status=0 where user_id='$usuario' and status=1";

            $query = mysqli_query($con, $sql) or die(mysqli_error($con));
            unset($sql);
            ######INSERE PONTOS RESTANTES

            $sql = "INSERT INTO historic_score SET  score = '$total', user_id='$usuario',leg='$resto',description='7',orders_package_id=-1, user_id_from=$usuario,status=1,
            level_from=0, created_at='" . date('Y-m-d H:i:s') . "',updated_at='" . date('Y-m-d H:i:s') . "' ";

            $query = mysqli_query($con, $sql) or die(mysqli_error($con));
            unset($sql);
        }
    }
}

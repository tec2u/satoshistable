<?php

error_reporting(E_ERROR | E_PARSE);
include "../config.php";


$query2 = "SELECT * FROM orders_package where package_id not in (8,9)";
$result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
while($refaz=mysqli_fetch_array($result2)){
####GLOBAL
$debug_mode="on";
$usuario=$refaz['user_id'];

$score=$refaz['price']; ####PONTUACAO DO PACOTE
$description=8; ####NOME DO BONUS (CONFIGBONUS)
$order_id=$refaz['id']; ####ID_PEDIDO DO USUARIO QUE PAGOU
$usuario1 = $usuario; ####USUARIO QUE COMPROU


					

$current_user_id = $usuario;


$level = 0;


while ($current_user_id != null) {
   
    $query = "SELECT id, recommendation_user_id FROM users WHERE id = $current_user_id";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    
    if ($row = mysqli_fetch_assoc($result)) {
        $usuario = $row['id'];
        $recommendation_user_id = $row['recommendation_user_id'];
        
       

        echo $sql_insert = "
            INSERT INTO historic_score 
            SET 
                score = '$score', 
                user_id = '$usuario', 
                description = '$description', 
                orders_package_id = $order_id,
                level_from = $level, 
                user_id_from = '$current_user_id', 
                leg = '$leg', 
                status = 1 ;
        ";
        echo "</br>";
       // mysqli_query($con, $sql_insert) or die(mysqli_error($con));
        
       // }
        $current_user_id = $recommendation_user_id;
        
        
        $level++;
    } else {
        
        break;
    }
}

}




?>

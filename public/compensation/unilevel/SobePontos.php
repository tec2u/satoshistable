<?php


/* include "../config.php";

error_reporting(E_ERROR | E_PARSE);
$p['user_id']=218;
$p['id']=212;
$p['price']=50;
$p['package_id']=1; */

echo "1";

####GLOBAL
$debug_mode="on";
$usuario=$p['user_id'];

$score=$p['price']; ####PONTUACAO DO PACOTE
$description=8; ####NOME DO BONUS (CONFIGBONUS)
$order_id=$p['id']; ####ID_PEDIDO DO USUARIO QUE PAGOU
$usuario1 = $usuario; ####USUARIO QUE COMPROU
echo "2";
if($p['package_id']==1){$type=2;}###Mensal
if($p['package_id']!=1){$type=1;}###Indicacao Direta nos nao mensal
echo "3";
$subscrition_bonus[1]=0.2;
$subscrition_bonus[2]=0.1;
$subscrition_bonus[3]=0.05;
$subscrition_bonus[4]=0.04;
$subscrition_bonus[5]=0.03;
$subscrition_bonus[6]=0.02;
$subscrition_bonus[7]=0.01;
							
echo "4";					

$current_user_id = $p['user_id'];


$level = 0;

echo "###################UNILEVEL######################## TYPE:$type, PRICE:$score, USER_1:$current_user_id";

while ($current_user_id != null) {
   
    $query = "SELECT id, recommendation_user_id FROM users WHERE id = $current_user_id";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    
    if ($row = mysqli_fetch_assoc($result)) {
        $usuario = $row['id'];
        $recommendation_user_id = $row['recommendation_user_id'];
        
       // if(ChecaExistePonto($con,$order_id,$usuario,$description)==0){
        

        if($level>0 and ChecaExistePonto($con,$order_id,$usuario,$description)==0){

            $totalPedido=ChecaTotalPedido($con,$usuario);

        

      echo  $sql_insert = "
            INSERT INTO historic_score 
            SET 
                score = '$score', 
                user_id = '$usuario', 
                description = '$description', 
                orders_package_id = $order_id,
                level_from = $level, 
                user_id_from = '$usuario1', 
                
                status = 1
        ";
        mysqli_query($con, $sql_insert) or die(mysqli_error($con));
    
        
        echo " LEVEL:$level  - USER:$usuario   |-------------------------CHECA TOTAL BONUS:".ChecaTotalBonus($con,$usuario)."-----------CHECA TOTAL PEDIDO:".(ChecaTotalPedido($con,$usuario)*3)."|      ";

        if($level==1 and $type=='1' and (ChecaTotalBonus($con,$usuario)<=(ChecaTotalPedido($con,$usuario)*3))###pacote normal --- MAX RECEBIMENTO 3x
            ){

            ####BONUS INDICACAO DIRETA

            if($totalPedido>=100 and $totalPedido<=250){

            $multiplicador = 0.08;

            }
            if($totalPedido==500){
                $multiplicador = 0.09;
            }
            if($totalPedido>=1000){
                $multiplicador = 0.1;
            }

            $banco_final=$score*$multiplicador;

            echo "#####BONUS DIRETO##### MULTIPLICADOR:$multiplicador";

           echo $sql = "INSERT INTO banco SET  price = '$banco_final', user_id='$usuario',description='9',order_id=$order_id,
            level_from=$level, created_at='".date('Y-m-d H:i:s')."',updated_at='".date('Y-m-d H:i:s')."' ";

            $query = mysqli_query($con,$sql)or die(mysqli_error($con));


        }
        
        
        echo '{{'.$type." - ".$level."----".ChecaTotalBonus($con,$usuario)."--".(ChecaTotalPedido($con,$usuario)*3)."}}";
        if($type=='2' and $level>0 and (ChecaTotalBonus($con,$usuario)<=(ChecaTotalPedido($con,$usuario)*3))){####MAX QUE PODE RECEBER 3x

           echo "####BONUS MENSAL####";

            $banco_final=$score*$subscrition_bonus[$level];

            echo $sql = "INSERT INTO banco SET  price = '$banco_final', user_id='$usuario',description='10',order_id=$order_id,
            level_from=$level, created_at='".date('Y-m-d H:i:s')."',updated_at='".date('Y-m-d H:i:s')."' ";

            $query = mysqli_query($con,$sql)or die(mysqli_error($con));

        }


        }
        $current_user_id = $recommendation_user_id;
        
        
        $level++;
    } else {
        
        break;
    }
}





?>

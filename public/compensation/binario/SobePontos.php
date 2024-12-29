<?php
####GLOBAL
$debug_mode="on";
$usuario=$p['user_id'];


if($p['price']>=2000){

    $score=$p['price']/2;

}else{$score=$p['price'];} ####PONTUACAO DO PACOTE




$description=7; ####NOME DO BONUS (CONFIGBONUS)
$order_id=$p['id']; ####ID_PEDIDO DO USUARIO QUE PAGOU
$usuario1 = $usuario; ####USUARIO QUE COMPROU

$level_from= 0;
$vazio=0;

echo "Score:$score | Vazio: $vazio | Usuario1:$usuario";
							
								while($vazio!=1){
                                    
                                    echo "Level From: $level_from  | ";

                                    $leg="";

                                    $s=mysqli_fetch_array(mysqli_query($con,"select * from binary_network where r_u = '".$usuario."' or l_u = '".$usuario."' "));
                                    
                                    $usuario_list[$level_from]=$usuario;
                                    $user_old_pts=$usuario_list[$level_from-1];

                                    echo "Checa Existe Ponto ($order_id,$usuario,$description): ".ChecaExistePonto($con,$order_id,$usuario,$description). " BINARIO: $s[id]| ";

									if($s['id']!="" and $usuario1 != $usuario){ 
                                        
                                                    ####NAO EH O MASTER NEM O USUARIO PAGADOR
                                                   
                                                    if(ChecaExistePonto($con,$order_id,$usuario,$description)==0){
                                                        
                                                        $leg = ChecaPerna($con,$user_old_pts);

                                                        echo $sql = "INSERT INTO historic_score SET  score = '$score', user_id='$usuario',description='$description',orders_package_id=$order_id,
                                                        level_from=$level_from,user_id_from=$usuario1,leg='$leg',status=1 ";
                                                        
                                                        if($debug_mode=="on"){echo  "$usuario $leg - $user_old_pts</br>";}
                                        
                                                        $query = mysqli_query($con,$sql)or die(mysqli_error($con)); 
                                                        
                                                        #####UPDATE TOTAL SCORE
                                                        
                                                        if($leg=='R'){$coluna='qty_total_right';}
                                                        elseif($leg=='L'){$coluna='qty_total_left';}

                                                        $user_atual=mysqli_fetch_array(mysqli_query($con,"select * from users where id = '".$usuario."' "));

                                                        $sql1 = "update users SET  $coluna = '".($user_atual[$coluna]+$score)."' where id='$usuario' ";

                                                        $query_update_total = mysqli_query($con,$sql1)or die(mysqli_error($con));
                                                        

                                                        

                                                    }

                                                    $usuario=$s['user_id'];
									
									}
									elseif($usuario1 != $usuario){
                                                    
                                                    $vazio=1;
                                                    ###PAGA O MASTER E PARA
                                                    echo "Entrou Master";
                                                    if(ChecaExistePonto($con,$order_id,$usuario,$description)==0){
                                                        
                                                        $leg = ChecaPerna($con,$user_old_pts);
                                                        
                                                        echo $sql = "INSERT INTO historic_score SET  score = '$score', user_id='$usuario',description='$description',orders_package_id=$order_id,
                                                        level_from=$level_from,user_id_from=$usuario1,leg='$leg',status=1 ";
                                                        
                                                        if($debug_mode=="on"){echo  "$usuario $leg - $user_old_pts</br>";}
                                        
                                                        $query = mysqli_query($con,$sql)or die(mysqli_error($con));

                                                        #####UPDATE TOTAL SCORE
                                                        
                                                        if($leg=='R'){$coluna='qty_total_right';}
                                                        elseif($leg=='L'){$coluna='qty_total_left';}

                                                        $user_atual=mysqli_fetch_array(mysqli_query($con,"select * from users where id = '".$usuario."' "));

                                                        $sql1 = "update users SET  $coluna = '".($user_atual[$coluna]+$score)."' where id='$usuario' ";

                                                        $query_update_total = mysqli_query($con,$sql1)or die(mysqli_error($con));
                                                        
                                                        
                                                        
                                                    }
                                                
                                    }else{
                                                    #####USUARIO PAGADOR
                                                    $usuario=$s['user_id'];

                                        }

                                   
                                        $level_from++;
                                        /* if($level_from>0){
                                            $user_old_pts=$s['user_id'];}else{$user_old_pts=$usuario1;} */
										
								}




?>

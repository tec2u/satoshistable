<div style="clear:both"></div><br><br><br><br>
<h2>Derramamento</h2>

<p>Escolha em que posição o seu cliente será posicionado, isto só poderá ser feito uma vez antes da ativação desse cliente</p>
 <?
 //echo $_POST[id_associado]."----".$_POST[perna_cad];
 if($_POST[id_associado]!=""){
	 
			//$s=mysql_fetch_array(mysql_query("select * from pedido where id_pacote_pedido=".$idp));
			$x=mysql_fetch_array(mysql_query("select * from dados where id=".$_POST[id_associado]));
			$ped=mysql_fetch_array(mysql_query("select * from pedido where idcliente_pacote=".$_POST[id_associado]));
		
			
			$idp=$ped[idpacote];
			$idcliente_pacote=$x[id];
			$login = $x[login];
			
			if($_POST[perna_cad]!=""){$patro[perna_cad]=$_POST[perna_cad];}
			
			$chk_existe = mysql_fetch_array(mysql_query("select * from dados where referido_1='$login' or referido_2='$login'"));
			if($chk_existe[id]==""){
			include "files/include/contagem_binaria.php";}
	 
	 
	 
 }
 
 
 
 ?>
 
 
 <div class="box-content" style="background-color:#fff">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Data de Cadastro</th>
                        </tr>
                        </thead>
                        <tbody>

						<?php
												###################################################################################
                                                #################CHECK SE O PATROCINADOR TEM TODOS POSICIONADOS####################
												###################################################################################
												$passa=1;
												
												$check_patro_posicionado_sql=mysql_query("SELECT * FROM dados 
												WHERE  dados.indicacao = '".$select[indicacao]."'");
												
												
												while($check_patro_posicionado=mysql_fetch_array($check_patro_posicionado_sql)){
												
												
													$check_existe_rede_binario=mysql_fetch_array(mysql_query("select * from dados 
													where referido_1='$check_patro_posicionado[login]' 
													or referido_2='$check_patro_posicionado[login]'"));
												
													if($check_existe_rede_binario[login]==""){$passa=0;}
												
												
												}
												
												###################################################################################
                                                #################FIM####################
												###################################################################################
												#########################################################
												
												
												
												###################################################################################
                                                #################CHECK SE O USUARIO LOGADO TEM TODOS POSICIONADOS####################
												###################################################################################
												
												//if($passa==1){
													
													
													
                                                $dados_sql = mysql_query("SELECT * FROM dados 
												WHERE  dados.indicacao = '".$_SESSION['usuario']."'") ;
                                                while($dados = mysql_fetch_array($dados_sql)) {
													
													
													
													$check_existe_rede_binario=mysql_fetch_array(mysql_query("select * from dados 
													where referido_1='$dados[login]' or referido_2='$dados[login]'"));
													
													if($check_existe_rede_binario[login]==""){
						
                                                   
													
															$data1 = explode("-",$dados['data_ativacao']);
                                                            $data = $data1['0']."/".$data1['1']."/".$data1['2'];
                                                            echo "
                                                                <tr>
                                                                    
                                                                    <td>".$dados['nome']."</td>
                                                                    <td>".$dados['login']."</td>
                                                                    <td>".$dados['celular']."</td>
                                                                  <td>".$dados['email']."</td>
                                                                    

                                                                    <td>".$data."</td>
																	 <td>";
																	 
																	 
																	 
																	 echo "<form action='' method='post'>";?>
																<select name='perna_cad' >
																	<option value='E' <?if($dados['perna_cad']=='E'){echo "selected=selected";}?>> ESQUERDA </option>
																	<option value='D' <?if($dados['perna_cad']=='D'){echo "selected=selected";}?>> DIREITA </option>
																	<option <?if($dados['perna_cad']==''){echo "selected=selected";}?>> MENOR </option>
																</select>
																<input type="submit" value="Posicionar" onclick="return confirm('Tem certeza de deseja posicionar esta pessoa nessa perna?');">
																<input type="hidden" name="id_associado" value="<?=$dados[id]?>">
																<?	 echo "</form>";
																	 
																	 
																	 echo "</td> </tr> ";
												}}
														

                                                
												//}

                                              ###################################################################################
                                                #################FIM####################
												###################################################################################  

                                                

                                            ?>
                       
                        </tbody>
                    </table>
                </div>
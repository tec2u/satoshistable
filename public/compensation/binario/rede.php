<?php
####GLOBAL

if($_GET['i'] == ""){$usuario=1;}else{$usuario=$_GET['i'];} ?><style>
select#derramamento {padding: 4px 20px;}
#derramamento form input[type="submit"] {padding: 0.64em;background: #0072c6;border: none;color: #fff;cursor: pointer;}
.radius{border-radius: 50%;width:50px; height:50px}
</style>


<?php
/////////////////////////////////INICIO SQLS


/****************************************************************************************************************************************************/
/****************************************************************************************************************************************************/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["derramamento"])) {
        //$muda = mysqli_query($con,"update dados set perna='".$_POST['derramamento']."' where login = '".$_SESSION['usuario']."'") or die(mysqli_error($con));
    }
}
/****************************************************************************************************************************************************/
///////////////////////////////////FIM INICIO SQLS

if (isset($usuario) && $usuario != "") {
    $c = mysqli_fetch_array(
        mysqli_query(
            $con,
            "SELECT * FROM users  join binary_network on users.id=binary_network.user_id WHERE users.id  = '$usuario'"
        )
    );
    $main_sponsor = $c["login"];
    $perna_selecionada = $c["perna_cad"];

    $consulta ="select * from users join binary_network on binary_network.user_id=users.id where users.id = '" .$usuario ."'";

    ($resultado = mysqli_query($con, $consulta)) or die(mysqli_error($con));
    if ($resultado) {
        $select = mysqli_fetch_assoc($resultado);
        $usuario = $select["login"];
        $indicados = $select["recommendation_user_id"];
        $referido_1 = $select["l_u"]; //primeiro referido do usuario logado
        $referido_2 = $select["r_u"]; //segundo referido
        $patrocinador = $select["recommendation_user_id"];
        $id_user = $usuario;
   
    }
}

#################################################################

$c1 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $referido_2 .
    "'"; // dados do segundo referido de quem esta logado (lado direito)
($r1 = mysqli_query($con, $c1)) or die("Falha");
$l1 = mysqli_fetch_assoc($r1);
$login_referido_2 = $l1["login"];

$ref21 = $l1["referido_1"]; //referido 1 do lado direito
$ref22 = $l1["referido_2"]; //referido 2 do lado esquerdo

$id_referido_2 = $l1["id"];

#################################################################

$c =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id ='" .
    $referido_1 .
    "'"; //dados do primeiro referido de quem esta logado (lado esquerdo)
($r = mysqli_query($con, $c)) or die("Falha");
$l = mysqli_fetch_assoc($r);
$login_referido_1 = $l["login"];
$ref11 = $l["referido_1"]; //referido 1 do lado direito
$ref12 = $l["referido_2"]; //referido 2 do lado esquerdo
$id_referido_1 = $l["id"];

###############################################################

$c2 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref11 .
    "'"; //referido 1 do lado direito do quem ta logado
($r2 = mysqli_query($con, $c2)) or die("Falha");
$l2 = mysqli_fetch_assoc($r2);
$login_ref11 = $l2["login"];
$ref112 = $l2["referido_1"];
$ref122 = $l2["referido_2"];
$id_ref11 = $l2["id"];

#############################################################

$c3 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref12 .
    "'"; //referido 1 do lado esquerdodo quem ta logado
($r3 = mysqli_query($con, $c3)) or die("Falha");
$l3 = mysqli_fetch_assoc($r3);
$login_ref12 = $l3["login"];
$ref31 = $l3["referido_1"];
$ref32 = $l3["referido_2"];
$id_ref12 = $l3["id"];

############################################################
$c4 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref21 .
    "'";
($r4 = mysqli_query($con, $c4)) or die("Falha");
$l4 = mysqli_fetch_assoc($r4);
$login_ref21 = $l4["login"];
$ref41 = $l4["referido_1"];
$ref42 = $l4["referido_2"];
$id_ref21 = $l4["id"];

#########################################################

$c5 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref22 .
    "'";
($r5 = mysqli_query($con, $c5)) or die("Falha");
$l5 = mysqli_fetch_assoc($r5);
$login_ref22 = $l5["login"];
$ref51 = $l5["referido_1"];
$ref52 = $l5["referido_2"];
$id_ref22 = $l5["id"];
$foto7 = $l5["caminho_foto"];

###################################################

$c7 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref112 .
    "'";
($r7 = mysqli_query($con, $c7)) or die("Falha");
$l7 = mysqli_fetch_assoc($r7);
$login_ref112 = $l7["login"];
$id_ref112 = $l7["id"];

#####################################################

$c8 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref122 .
    "'";
($r8 = mysqli_query($con, $c8)) or die("Falha");
$l8 = mysqli_fetch_assoc($r8);
$login_ref122 = $l8["login"];
$id_ref122 = $l8["id"];

#####################################################

$c9 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref31 .
    "'";
($r9 = mysqli_query($con, $c9)) or die("Falha");
$l9 = mysqli_fetch_assoc($r9);
$login_ref31 = $l9["login"];
$id_ref31 = $l9["id"];

#####################################################

$c10 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref32 .
    "'";
($r10 = mysqli_query($con, $c10)) or die("Falha");
$l10 = mysqli_fetch_assoc($r10);
$login_ref32 = $l10["login"];
$id_ref32 = $l10["id"];

#####################################################

$c11 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref41 .
    "'";
($r11 = mysqli_query($con, $c11)) or die("Falha");
$l11 = mysqli_fetch_assoc($r11);
$login_ref41 = $l11["login"];
$id_ref41 = $l11["id"];

#####################################################

$c12 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref42 .
    "'";
($r12 = mysqli_query($con, $c12)) or die("Falha");
$l12 = mysqli_fetch_assoc($r12);
$login_ref42 = $l12["login"];
$id_ref42 = $l12["id"];

#####################################################

$c13 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id ='" .
    $ref51 .
    "'";
($r13 = mysqli_query($con, $c13)) or die("Falha");
$l13 = mysqli_fetch_assoc($r13);
$id_ref51 = $l13["id"];
$login_ref51 = $l13["login"];

#####################################################

$c14 =
    "select users.login as login,users.name as nome,binary_network.l_u as referido_1,binary_network.r_u as referido_2,users.activated as ativacao,users.id as id,users.image_path as caminho_foto,users.recommendation_user_id as indicacao from users join binary_network on users.id=binary_network.user_id where binary_network.user_id = '" .
    $ref52 .
    "'";
($r14 = mysqli_query($con, $c14)) or die("Falha");
$l14 = mysqli_fetch_assoc($r14);
$login_ref52 = $l14["login"];
$id_ref52 = $l14["id"];

#####################################################


?>
<div class="well-header" style='text-align: center;'>
	<h3><?= $t["rede_gerenciarequipe"] ?></h3>
</div>
<div class="geral_content" style='width: 900px;'>
	

<div id="derramamento" style="margin-top: 120px;text-align: center;">
		<form action="" method="post">
			<label for="derramamento"><?= $t["rede_derramamento"] ?></label>
			<select name="derramamento" id="derramamento">
				<option value="D" <?php if ($perna_selecionada == "D") {
        echo "selected=selected";
    } ?>><?= $t["rede_direita"] ?></option>
				<option value="E" <?php if ($perna_selecionada == "E") {
        echo "selected=selected";
    } ?>><?= $t["rede_esquerda"] ?></option>
				<option value="M" <?php if ($perna_selecionada == "M") {
        echo "selected=selected";
    } ?>><?= $t["rede_menor"] ?></option>		
			</select>
			<input type="submit" value="Mudar">
		</form>
</div>



<div id="main">
  <div id="sidetree" align="center">
<div class="treeheader" align="center">
<form name="matriz" action="salvar_matriz.php" method="post">
<div style='width:970px;height: 66px;float:left;margin-bottom: 15px;' align="center">

<?php
if ($foto == "") {
    $foto = "images/user_yellow.png";
}

echo "
		<div style='width:970px;height:80px;float:left;' align='center' id='associado' onmouseover='troca()' onmouseout='trocab()'>
			<div class='tooltip2'>
  			
				<img src=$foto width='50' height='50' class='radius'>
			</div>
			<br/>
		<b>$usuario</b>
		</div>
		";
echo "<input type='hidden' name='lider' value='" . $usuario . "'>";
?>


</div>

<div style='width:1100px; height:50px; float:left;'>

<div style='margin: 18px 0 0 259px;float:left; ' align='right'>
	<img src="images/binary3.png" >

</div>
<div style='width:415px;height:50px;float:right;' align='left'>


</div>
</div>
<div style='width:1100px; height:65px; float:left;'>
<div style='width:295px;height:50px;float:left;' align='right'>
<?php if ($referido_1 != "") {
    if ($foto3 == "") {
        $foto3 = "images/user_yellow.png";
    }
    echo "
		<a href='?p=downline&i=$referido_1'>
		<div class='tooltip2'>
  			
			<img src=$foto3 class='radius'  width='50' height='50' class='radius'>
		</div>
		</a>
		";

    /****************************************************************************************/
    if (isset($esquerda) && !empty($esquerda)) {
        
    }
    /****************************************************************************************/
} else {
    echo "	
		<img src='images/user_gray.png' width='50' height='50'>
	";
} ?>

</div>
<div style='width:420px;height:50px;float:right;' align='left'>
<?php if ($referido_2 != "") {
    if ($foto2 == "") {
        $foto2 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$referido_2'>
<div class='tooltip2'>
	
	<img src=$foto2 class='radius'  width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
<img src='images/user_gray.png' width='50' height='50'>
";
} ?>

</div>
</div>
<div style="width:1100px; height:20px; float:left;">
  <div style='width:400px;height:20px;float:left; margin-left:70px;' align='center'>

<?php if ($referido_1 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l["login"];
    echo "<input type='hidden' value='" . $referido_1 . "' name='referido_1'>";
    echo "</b>";
} ?>

</div>
<div style='width:250px;height:20px;float:right; margin-right:270px' align='center'>
<?php if ($referido_2 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l1["login"];
    echo "<input type='hidden' value='" . $referido_2 . "' name='referido_2'>";
    echo "</b>";
} ?>
</b>
</div>
</div>
<div style='width:1100px; height:55px; float:left;'>


<div style='margin: 0px 0 0 150px;float:left;' align='right'>
<img src="images/binary.png" >

</div>
<div style="width:200px; height:50px; float:left;" align="right">


</div>
<div style='width:305px;height:50px;float:right;' align='left'>


</div>
<div style="margin: -3px -15px 0 0; float:right;" align="left">
<img src="images/binary.png" >

</div>
</div>
<div style='width:1100px; height: 62px; float:left;'>
<div style='width:185px;height:50px;float:left;' align='right'>
<?php if ($ref11 != "") {
    if ($foto4 == "") {
        $foto4 = "images/user_yellow.png";
    }

    echo "
	<a href='?p=downline&i=$ref11'>
	<div class='tooltip2'>
  		
		<img src=$foto4 class='radius'   width='50' height='50' class='radius'>
	</div>
	</a>
	";
    
    //}
} else {
    echo "

<img src='images/user_gray.png' width='50' height='50'>
";
} ?>

</div>
<div style='width:200px;height:50px;float:left;' align='right'>
<?php if ($ref12 != "") {
    if ($foto5 == "") {
        $foto5 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref12'>
<div class='tooltip2'>
  	
	<img src=$foto5 class='radius'  width='50' height='50'>
</div>
</a>
";
    
} else {
    echo "

<img src='images/user_gray.png' width='50' height='50'>
";
} ?>

</div>

<div style='width:310px;height:50px;float:right;' align='left'>

<?php if ($ref22 != "") {
    if ($foto7 == "") {
        $foto7 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref22'>
<div class='tooltip2'>
  	
	<img src=$foto7  class='radius'  width='50' height='50' >
</div>
</a>
";
    
} else {
    echo "

<img src='images/user_gray.png' width='50' height='50'>
";
} ?>

</div>
<div style='width:225px;height:50px;float:right;' align='left'>
<?php if ($ref21 != "") {
    if ($foto6 == "") {
        $foto6 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref21'>
<div class='tooltip2'>
	
	<img src=$foto6 class='radius'  width='50' height='50'>
</div>
</a>
";
    
} else {
    echo "

<img src='images/user_gray.png' width='50' height='50'>
";
} ?>
</div>
</div>

<div style="width:1100px; height:20px; float:left;">
<div style='width:120px;height:20px;float:left; margin-left:100px; ' align='center'>

<?php if ($ref11 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l2["login"];
    echo "<input type='hidden' value='" . $ref11 . "' name='ref11'>";
    echo "</b>";
} ?>

</div>
<div style='width:120px;height:20px;float:left; margin-left:80px; ' align='center'>

<?php if ($ref12 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l3["login"];
    echo "<input type='hidden' value='" . $ref12 . "' name='ref12'>";
    echo "</b>";
} ?>

</div>
<div style='width:120px;height:20px;float:left; margin-left:110px; ' align='center'>

<?php if ($ref21 == "") {
    echo $t["rede_vazio"] . "--";
} else {
    echo "<b>";
    echo $l4["login"];
    echo "<input type='hidden' value='" . $ref21 . "' name='ref21'>";
    echo "</b>";
} ?>

</div>
<div style='width:120px;height:20px;float:left; margin-left:110px;' align='center'>

<?php if ($ref22 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l5["login"];
    echo "<input type='hidden' value='" . $ref22 . "' name='ref22'>";
    echo "</b>";
} ?>

</div>
</div>

<div style='width:1100px; height:50px; float:left;'>
<div style='width:115px;height:50px;float:left;' align='right'>


</div>
<div style="margin: 0 0 0 -23px; float:left;" align="right">
<img src="images/binary2.png" >

</div>

<div style="width:90px; height:50px; float:left;" align="right">


</div>

<div style="margin:0 0 0 -10px; float:left;" align="right">

<img src="images/binary2.png" >
</div>

<div style='width:245px;height:50px;float:right;' align='left'>


</div>
<div style="margin: 0 -21px 0 0; float:right;" align="left">

<img src="images/binary2.png" >
</div>

<div style="width:100px; height:50px; float:right;" align="left">


</div>

<div style="margin: 0 2px 0 0; float:right;" align="left">
<img src="images/binary2.png" >

</div>
</div>
<div style='width:1100px; height:63px; float:left;'>
<div style='width:120px;height:50px;float:left;' align='right'>
  <?php
  if ($ref112 != "") {
      if ($foto8 == "") {
          $foto8 = "images/user_yellow.png";
      }

      echo "
<a href='?p=downline&i=$ref112'>
<div class='tooltip2'>
	
	<img src=$foto8  width='50' height='50' class='radius'>
</div>
</a>
";
  }
   else {
      echo "
<img src='images/user_gray.png' width='50' height='50'>
";
  }
  ?>
</div>
<div style='width:110px;height:50px;float:left; ' align='right'>
<?php if ($ref122 != "") {
    if ($foto9 == "") {
        $foto9 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref11'>
<div class='tooltip2'>
  	
	<img src=$foto9 width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
<img src='images/user_gray.png' width='50' height='50'>
";
} ?>
</div>
<div style='width:90px;height:50px;float:left;' align='right'>

<?php if ($ref31 != "") {
    if ($foto10 == "") {
        $foto10 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref31'>
<div class='tooltip2'>
  	
	<img src=$foto10 width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
<img src='images/user_gray.png' width='50' height='50'>

";
} ?>

</div>
<div style='width:120px;height:50px;float:left;' align='right'>

<?php if ($ref32 != "") {
    if ($foto11 == "") {
        $foto11 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref32'>
<div class='tooltip2'>
  	
	<img src=$foto11  width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
<img src='images/user_gray.png' width='50' height='50'>

";
} ?>

</div>

<div style='width:250px;height:50px;float:right;' align='left'>

<?php if ($ref52 != "") {
    if ($foto15 == "") {
        $foto15 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref52'>
<div class='tooltip2'>
  	
	<img src=$foto15  width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
</a>
<img src='images/user_gray.png' width='50' height='50'> 

";
} ?>

</div>

<div style='width:120px;height:50px;float:right; ' align='left'>

<?php if ($ref51 != "") {
    if ($foto14 == "") {
        $foto14 = "images/user_yellow.png";
    }

    echo "
<a href='?p=downline&i=$ref51'>
<div class='tooltip2'>
  	
	<img src=$foto14  width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
</a>
<img src='images/user_gray.png' width='50' height='50'>

";
} ?>

</div>
<div style='width:100px;height:50px;float:right;' align='left'>

<?php if ($ref42 != "") {
    if ($foto13 == "") {
        $foto13 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref42'>
<div class='tooltip2'>
	
	<img src=$foto13 width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
</a>
<img src='images/user_gray.png' width='50' height='50'>

";
} ?>

</div>
<div style='width:130px;height:50px;float:right;' align='left'>

<?php if ($ref41 != "") {
    if ($foto12 == "") {
        $foto12 = "images/user_yellow.png";
    }
    echo "
<a href='?p=downline&i=$ref41'>
<div class='tooltip2'>
  	
	<img src=$foto12  width='50' height='50' class='radius'>
</div>
</a>
";
    
} else {
    echo "
	<img src='images/user_gray.png' width='50' height='50'>
	
";
} ?>

</div>

</div>
   <div style="width:1100px; height:20px; float:left;">

<div style='width:120px;height:20px;float:left; margin-left:35px; ' align='center'>

<?php if ($ref112 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l7["login"];
    echo "<input type='hidden' value='" . $ref112 . "' name='ref112'>";
    echo "</b>";
} ?>

</div>
<div style='width:100px;height:20px;float:left;  ' align='center'>

<?php if ($ref122 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l8["login"];
    echo "<input type='hidden' value='" . $ref122 . "' name='ref122'>";
    echo "</b>";
} ?>

</div>
<div style='width:85px;height:20px;float:left;  ' align='center'>

<?php if ($ref31 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l9["login"];
    echo "<input type='hidden' value='" . $ref31 . "' name='ref31'>";
    echo "</b>";
} ?>

</div>
<div style='width:150px;height:20px;float:left; ' align='center'>

<?php if ($ref32 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l10["login"];
    echo "<input type='hidden' value='" . $ref32 . "' name='ref32'>";
    echo "</b>";
} ?>

</div>

<div style='width:75px;height:20px;float:left; ' align='center'>

<?php if ($ref41 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l11["login"];
    echo "<input type='hidden' value='" . $ref41 . "' name='ref41'>";
    echo "</b>";
} ?>

</div>
<div style='width:100px;height:20px;float:left; margin-left:40px; ' align='center'>

<?php if ($ref42 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l12["login"];
    echo "<input type='hidden' value='" . $ref42 . "' name='ref42'>";
    echo "</b>";
} ?>

</div>
<div style='width:105px;height:20px;float:left; ' align='center'>

<?php if ($ref51 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l13["login"];
    echo "<input type='hidden' value='" . $ref51 . "' name='ref51'>";
    echo "</b>";
} ?>

</div>
<div style='width:130px;height:20px;float:left; ' align='center'>

<?php if ($ref52 == "") {
    echo $t["rede_vazio"];
} else {
    echo "<b>";
    echo $l14["login"];
    echo "<input type='hidden' value='" . $ref52 . "' name='ref52'>";
    echo "</b>";
} ?>

</div>

</div>

</form>


</div>


</div>
</div>

<br>

<div style='clear:both;'></div>
<br>
</div>

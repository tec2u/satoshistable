<?php

if($_GET['i'] == ""){$usuario=1;}else{$usuario=$_GET['i'];} 

 $consulta = "select * from users join binary_network on binary_network.user_id=users.id where binary_network.user_id=$usuario";
$linha1_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l1 = mysqli_fetch_assoc($linha1_sql);
if($l1['login']!=""){$imagel1 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel1='https://cdn-icons-png.flaticon.com/512/149/149071.png';}

###########Linha 2

$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l1[l_u]'";
$linha2p1_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l2p1 = mysqli_fetch_assoc($linha2p1_sql);
if($l2p1['login']!=""){$imagel2p1 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel2p1='https://cdn-icons-png.flaticon.com/512/149/149071.png';}

$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l1[r_u]'";
$linha2p2_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l2p2 = mysqli_fetch_assoc($linha2p2_sql);
if($l2p2['login']!=""){$imagel2p2 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel2p2='https://cdn-icons-png.flaticon.com/512/149/149071.png';}

###########Linha 3

$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l2p1[l_u]'";
$linha3p1_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l3p1 = mysqli_fetch_assoc($linha3p1_sql);
if($l3p1['login']!=""){$imagel3p1 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel3p1='https://cdn-icons-png.flaticon.com/512/149/149071.png';}

//var_dump($l3p1);

$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l2p1[r_u]'";
$linha3p2_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l3p2 = mysqli_fetch_assoc($linha3p2_sql);
if($l3p2['login']!=""){$imagel3p2 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel3p2='https://cdn-icons-png.flaticon.com/512/149/149071.png';}

$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l2p2[l_u]'";
$linha3p3_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l3p3 = mysqli_fetch_assoc($linha3p3_sql);
if($l3p3['login']!=""){$imagel3p3 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel3p3='https://cdn-icons-png.flaticon.com/512/149/149071.png';}

$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l2p2[r_u]'";
$linha3p4_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l3p4 = mysqli_fetch_assoc($linha3p4_sql);
if($l3p4['login']!=""){$imagel3p4 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel3p4='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


###########Linha 4

$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p1[l_u]'";
$linha4p1_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p1 = mysqli_fetch_assoc($linha4p1_sql);
if($l4p1['login']!=""){$imagel4p1 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p1='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p1[r_u]'";
$linha4p2_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p2 = mysqli_fetch_assoc($linha4p2_sql);
if($l4p2['login']!=""){$imagel4p2 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p2='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p2[l_u]'";
$linha4p3_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p3 = mysqli_fetch_assoc($linha4p3_sql);
if($l4p3['login']!=""){$imagel4p3 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p3='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p2[r_u]'";
$linha4p4_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p4 = mysqli_fetch_assoc($linha4p4_sql);
if($l4p4['login']!=""){$imagel4p4 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p4='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p3[l_u]'";
$linha4p5_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p5 = mysqli_fetch_assoc($linha4p5_sql);
if($l4p5['login']!=""){$imagel4p5 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p5='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p3[r_u]'";
$linha4p6_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p6 = mysqli_fetch_assoc($linha4p6_sql);
if($l4p6['login']!=""){$imagel4p6 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p6='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p4[l_u]'";
$linha4p7_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p7 = mysqli_fetch_assoc($linha4p7_sql);
if($l4p7['login']!=""){$imagel4p7 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p7='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


$consulta = "select * from users join binary_network on binary_network.user_id=users.id where users.id='$l3p4[r_u]'";
$linha4p8_sql = mysqli_query($con, $consulta) or die(mysqli_error($con));
$l4p8 = mysqli_fetch_assoc($linha4p8_sql);
if($l4p8['login']!=""){$imagel4p8 = 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png';}else{$imagel4p8='https://cdn-icons-png.flaticon.com/512/149/149071.png';}


?>




<style>

/*Now the CSS*/
* {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #666;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}
.tree img {width:50px}
</style>

<div class="tree">
	<ul>
		<li>
			<a href="#">
				<?php
				if($l1['login']==""){}
				?>
                <img src='<?=$imagel1?>' >
                </br><?=$l1['login']?>
                </br><?=$l1['qty_total_left']?> | <?=$l1['qty_total_right']?>
            </a>
                <ul>
				<li>
					<a href="#">
                    <img src='<?=$imagel2p1?>' >  
                    </br><?=$l2p1['login']?>
                    </br><?=$l2p1['qty_total_left']?> | <?=$l2p1['qty_total_right']?>
                    </a>
					<ul>
                         <li>
						 <a href="#">
						 <img src='<?=$imagel2p2?>' > 
						</br><?=$l3p1['login']?>
						</br><?=$l3p1['qty_total_left']?> | <?=$l3p1['qty_total_right']?>
						</a>
                            <ul>
                                <li>
								<a href="#">
								<img src='<?=$imagel4p1?>' >   
                    </br><?=$l4p1['login']?>
                    </br><?=$l4p1['qty_total_left']?> | <?=$l4p1['qty_total_right']?>
                    </a>
                    
                                </li>
                                <li>
								<a href="#">
								<img src='<?=$imagel4p2?>' > 
                    </br><?=$l4p2['login']?>
                    </br><?=$l4p2['qty_total_left']?> | <?=$l4p2['qty_total_right']?>
                    </a>
                                </li>
					        </ul>
						</li>
						<li>
						<a href="#">
						<img src='<?=$imagel3p2?>' >  
                    </br><?=$l3p2['login']?>
                    </br><?=$l3p2['qty_total_left']?> | <?=$l3p2['qty_total_right']?>
                    </a>
                            <ul>
                         <li>
						 <a href="#">
						 <img src='<?=$imagel4p3?>' >    
                    </br><?=$l4p3['login']?>
                    </br><?=$l4p3['qty_total_left']?> | <?=$l4p3['qty_total_right']?>
                    </a>
              
						</li>
						<li>
						<a href="#">
						<img src='<?=$imagel4p4?>' >     
                    </br><?=$l4p4['login']?>
                    </br><?=$l4p4['qty_total_left']?> | <?=$l4p4['qty_total_right']?>
                    </a>
						</li>
					</ul>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">
                    <img src='<?=$imagel2p2?>' >     
                    </br><?=$l2p2['login']?>
                    </br><?=$l2p2['qty_total_left']?> | <?=$l2p2['qty_total_right']?>
                    </a>
					<ul>
						<ul style='margin-left: -32px;'>
            <li>
			<a href="#">
			<img src='<?=$imagel3p3?>' >     
                    </br><?=$l3p3['login']?>
                    </br><?=$l3p3['qty_total_left']?> | <?=$l3p3['qty_total_right']?>
                    </a>
              <ul>
            <li>
			<a href="#">
			<img src='<?=$imagel4p5?>' >     
                    </br><?=$l4p5['login']?>
                    </br><?=$l4p5['qty_total_left']?> | <?=$l4p5['qty_total_right']?>
                    </a>
						</li>
						<li>
						<a href="#">
						<img src='<?=$imagel4p6?>' >     
                    </br><?=$l4p6['login']?>
                    </br><?=$l4p6['qty_total_left']?> | <?=$l4p6['qty_total_right']?>
                    </a>
						</li>
					</ul>
						</li>
						<li>
						<a href="#">
						<img src='<?=$imagel3p4?>' >     
                    </br><?=$l3p4['login']?>
                    </br><?=$l3p4['qty_total_left']?> | <?=$l3p4['qty_total_right']?>
                    </a>
                            <ul>
                         <li>
						 <a href="#">
						 <img src='<?=$imagel4p7?>' >     
                    </br><?=$l4p7['login']?>
                    </br><?=$l4p7['qty_total_left']?> | <?=$l4p7['qty_total_right']?>
                    </a>
              
						</li>
						<li>
						<a href="#">
						<img src='<?=$imagel4p8?>' >     
                    </br><?=$l4p8['login']?>
                    </br><?=$l4p8['qty_total_left']?> | <?=$l4p8['qty_total_right']?>
                    </a>
						</li>
					</ul>
						</li>
					</ul>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</div>
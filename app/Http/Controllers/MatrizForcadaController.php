<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\EcommOrders;
use App\Models\HistoricScore;
use App\Models\MatrizForcada;
use App\Models\OrderPackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;



class MatrizForcadaController extends Controller
{

    protected $link_DB;

    public function virgulino($array)
    {
        $texto = "";
        $total = count($array);

        $count = 1;

        foreach ($array as $a) {

            $texto .= "$a";

            if ($count < $total) {
                $texto .= ",";
            }

            $count++;
        }

        return $texto;
    }


    function soma_matriz($fato_gerador)
    {
        $sair = 1;
        $count = 1;
        while ($sair == 1) {

            $nivel_self = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where id='" . $fato_gerador . "' order by id asc limit 1"));
            $soma_qty1 = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where id='" . $nivel_self['upline'] . "' order by id asc limit 1"));
            $qty_nova = $soma_qty1['qty'] + 1;

            echo "update matriz_forcada3x10 set qty='$qty_nova' where  id='" . $nivel_self['upline'] . "'";
            mysqli_query($this->link_DB, "update matriz_forcada3x10 set qty='$qty_nova' where  id='" . $nivel_self['upline'] . "'");

            $nivel1 = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where id='" . $nivel_self['upline'] . "' order by id asc limit 1"));
            $nivel12 = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where upline='" . $nivel1['upline'] . "' order by id asc limit 1"));

            if ($count == 7 || $nivel_self['upline'] == "" || !$nivel12) {
                $sair = 0;
            }
            $count++;
            $fato_gerador = $nivel12 ? $nivel12['id'] : 0;
        }
    }

    function scriptBonusCorrigir()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $orders = OrderPackage::where('payment_status', 1)->where('status', 1)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

        foreach($orders as $order)
        {
            $matriz = MatrizForcada::where('id_dados', $order->user_id)->first();
            $this->bonusDivisao($matriz->id, $order->id);
        }
    }

    function bonusDivisao($fato_gerador, $number_order)
    {
        $this->link_DB = mysqli_connect('127.0.0.1', 'satoshi', 'satoshi') or die(mysqli_error($this->link_DB));
        $GLOBALS['link_DB'] = $this->link_DB;

        if (!$this->link_DB) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        mysqli_select_db($this->link_DB, 'satoshi');

        mysqli_query($this->link_DB, "SET NAMES 'utf8'");

        $user_gerou_package = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where id='" . $fato_gerador . "' order by id asc limit 1"));
        $sair = 1;
        $count = 1;
        while ($sair == 1) {

            $nivel_self = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where id='" . $fato_gerador . "' order by id asc limit 1"));
            $soma_qty1 = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where id='" . $nivel_self['upline'] . "' order by id asc limit 1"));

            switch ($count) {
                case 1:
                    $price = 7;
                    break;
                case 2:
                    $price = 17;
                    break;
                case 3:
                    $price = 12;
                    break;
                case 4:
                    $price = 3;
                    break;
                case 5:
                    $price = 2;
                    break;
                case 6:
                    $price = 1;
                    break;

            }

            if ($soma_qty1 && $soma_qty1['id_dados'] >= 1) {
                    Banco::create([
                        'price' => $price,
                        'user_id' => $soma_qty1['id_dados'],
                        'order_id' => $number_order,
                        'status' => 1,
                        'description' => 1,
                        'level_from' => $count,
                        'origin_bonus' => $user_gerou_package['id_dados'],

                    ]);
            }
            $nivel1 = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where id='" . $nivel_self['upline'] . "' order by id asc limit 1"));
            $nivel12 = [];
            if ($nivel1) {
                $nivel12 = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where upline='" . $nivel1['upline'] . "' order by id asc limit 1"));
            }

            if ($count == 7 || $nivel_self['upline'] == "" || !$nivel12) {
                $sair = 0;
            }
            $count++;
            $fato_gerador = $nivel12 ? $nivel12['id'] : 0;
        }
    }

    public function carregarMatriz()
    {
        $lista_id_usuarios = [

        ];

        foreach ($lista_id_usuarios as $id) {
            $this->matriz_forcada($id);
        }
    }

    public function carregarUsersHistoricScore()
    {
        $lista_id_usuarios = [
            116809,
            // 116830,
            // 117152,
            // 117159,
            // 116832,
            // 116835,
            // 116839,
            // 116843,
            // 117160,
            // 116845,
            // 116846,
            // 116857,
            // 116859,
            // 116862,
            // 116864,
            // 116901,
            // 117178,
            // 116986,
            // 117009,
            // 117012,
            // 117014,
            // 117022,
            // 117070,
            // 117169,
            // 117186,
            // 117202,
            // 116987,
            // 117016,
            // 117229
        ];
        foreach ($lista_id_usuarios as $id) {
            $this->alimentaHistoricScore($id);
        }
    }

    public function alimentaHistoricScore($id)
    {
        $user = User::find($id);
        $sair = 1;
        $count = 1;
        $primeiro_id = $user->id;
        $fato_gerador = $user->id;
        // ini_set('max_execution_time', '300');
        while ($sair == 1) {
            $nivel_self = User::where('id', $fato_gerador)->first();
            if ($nivel_self->recommendation_user_id == NULL)
                break;
            $soma_qty1 = User::where('id', $nivel_self->recommendation_user_id)->first();
            if ($soma_qty1 != NULL && $soma_qty1->recommendation_user_id >= 0) {
                if ($nivel_self->name != "") {
                    $check_existe = HistoricScore::where('user_id_from', $primeiro_id)->where('user_id', $soma_qty1->id)->where('description', '6')->first();
                    if ($check_existe == NULL) {
                        HistoricScore::create([
                            'score' => '1',
                            'user_id' => $soma_qty1->id,
                            'status' => '1',
                            'description' => 'Contador',
                            'level_from' => $count,
                            'orders_package_id' => 0,
                            'user_id_from' => $primeiro_id
                        ]);
                        if ($soma_qty1->qty == NULL) {
                            User::where('id', $nivel_self->recommendation_user_id)->update(['qty' => 1]);
                        } else {
                            User::where('id', $nivel_self->recommendation_user_id)->increment('qty', 1);
                        }
                    }
                }
                $nivel1 = User::where('id', $nivel_self->recommendation_user_id)->first();
                $nivel12 = User::where('recommendation_user_id', $nivel1->recommendation_user_id)->first();
                $count++;
                $fato_gerador = $nivel12->id;
            }
        }
    }

    public function matriz_forcada($id)
    {
        $this->link_DB = mysqli_connect('127.0.0.1', 'moments4_SCI', 'scimkt.com.br') or die(mysqli_error($this->link_DB));

        $GLOBALS['link_DB'] = $this->link_DB;

        if (!$this->link_DB) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        mysqli_select_db($this->link_DB, 'moments4_SCI');

        mysqli_query($this->link_DB, "SET NAMES 'utf8'");

        $config = array();
        $config['horizontal'] = 4;
        $config['vertical'] = 6;
        $config['total_rede'] = 88572;
        $config['tem_reciclagem'] = 1; ###1=Sim / 0=N�o

        $user = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from users where id=$id")); //pega o codigo do usuario
        $procura_patrocinador = mysqli_fetch_array(mysqli_query($this->link_DB, "select * from users where id='" . $user['recommendation_user_id'] . "'")); //pega o patrocinador do usuario que indicou
        $patrocinador = mysqli_fetch_array(mysqli_query($this->link_DB, "select id,ciclo from matriz_forcada3x10 where  id_dados='" . $procura_patrocinador['id'] . "' order by id desc limit 1")); //pega patrocinador do $produra_patrocinador
        $counter = 0;
        $usuario = $user['id']; //coloca o id do usuario em $usuario

        $ciclo_sql = mysqli_fetch_array(mysqli_query($this->link_DB, "select count(*) as total from matriz_forcada3x10 where id_dados=$id")); // pega quantidade total da rede da matriz do id do usuario inicial
        $ciclo = $ciclo_sql['total']; //coloca o total aqui

        $ciclo_patro_sql = mysqli_fetch_array(mysqli_query($this->link_DB, "select count(*) as total from matriz_forcada3x10 where id_dados=$id")); // pega quantidade total da rede da matriz do id do usuario inicial
        $ciclo_patro = $ciclo_patro_sql['total']; //coloca o total aqui

        if ($ciclo == 0 or $ciclo == "") {
            $ciclo = 1;
        } else {
            $ciclo++;
        }

        ####CONFIGURA OS ARRAYS
        //INSERE O NIVEIS VERTICAIS DA MATRIZ FORÇADA
        for ($i = 1; $i <= $config['vertical'] + 2; $i++) {

            $arr = "array_unilevel$i"; // cria array chamado $array_unilevel concatenado com o $i array_unilevel1 array_unilevel2 array_unilevel3 array_unilevel4

            $$arr = array();
        }




        ####COLOCA NO 1� ARRAY O 1� PATROCINADOR

        if (count($array_unilevel1) == 0) {
            $array_unilevel1[0] = $patrocinador['id'];
        }

        ####PREENCHE OS ARRAYS
        for ($i = 1; $i <= $config['vertical'] + 1; $i++) {

            $var = "array_unilevel" . ($i); //array_unilevel1 = id do patrocinador array_unilevel2
            $fetchs = "s1$i";

            $sqls = "sql_array$i";

            //se $i for igual a 0 ele sai do loop
            if (count($$var) == 0) {
                break;
            }

            //pega niveis abaixo do patrocinador
            $$sqls = mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where upline in (" . $this->virgulino($$var) . ") order by id asc");

            if ($i == 1) {
                ###LIMPA A ARRAY ANTES DE INSERIR NOVOS VALORES
                $array_unilevel1 = array();
            }
            //if(count($$var)>0){
            while ($$fetchs = @mysqli_fetch_array($$sqls)) {
                $var = "array_unilevel" . ($i + 1); //array_unilevel1 vira array_unilevel3 até a 10 posição vertical
                $pega_fetch = $$fetchs;
                array_push($$var, $pega_fetch['id']); //preenche array horizontal até o 3 inserindo id do usuario da matriz sempre no final
            }
        }


        #### FIM PREENCHE OS ARRAYS
        ####################################################################

        $max = $config['horizontal'] - 1; //$config = 2


        $fetchs = "s1$i";

        $sqls = "sql_array$i";
        $pass = 0;
        //array_unilevel2
        #### A PARTIR DE AQUI ELE POSICIONA
        ####NIVEL 1
        if (count($array_unilevel2) <= $max) {
            mysqli_query($this->link_DB, "insert into matriz_forcada3x10 set upline='" . $patrocinador['id'] . "',  id_dados='" . $usuario . "', ciclo='$ciclo',created_at='" . date('Y-m-d H:i:s') . "'");
            $id_linha = mysqli_insert_id($this->link_DB);
            $this->soma_matriz($id_linha);

            // $this->bonusDivisao($id_linha);
            $pass = 1;
        }
        ####NIVEL >1
        for ($i = 2; $i <= $config['vertical']; $i++) {

            $var = "array_unilevel$i";

            if (count($$var) > 0 and $pass != 1) {

                foreach ($$var as $value) {
                    echo "pass=$i";

                    $check_qty_rede_sql = mysqli_query($this->link_DB, "select * from matriz_forcada3x10 where upline='" . $value . "'");
                    $check_qty = mysqli_num_rows($check_qty_rede_sql);

                    if ($check_qty <= ($max)) {
                        mysqli_query($this->link_DB, "insert into matriz_forcada3x10 set upline='" . $value . "',  id_dados='" . $usuario . "', ciclo='$ciclo',created_at='" . date('Y-m-d H:i:s') . "'");
                        $id_linha = mysqli_insert_id($this->link_DB);
                        $this->soma_matriz($id_linha);
                        // $this->bonusDivisao($id_linha);
                        $pass = 1;
                        break;

                        echo "final0";
                    }
                    echo "final1";
                }
            }
            #######FIM NIVEL>1

            echo "final2";
        }
        #### FIM POSICIONA

        echo "final3";
    }
}

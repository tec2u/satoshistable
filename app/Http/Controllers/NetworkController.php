<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerUser;
use App\Models\EcommOrders;
use App\Models\EcommRegister;
use App\Models\HistoricScore;
use App\Models\MatrizForcada;
use App\Models\OrderPackage;
use App\Models\PaymentOrderEcomm;
use App\Models\Product;
use App\Models\Propertie;
use App\Models\Rede;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NetworkController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function mytree($parameter)
    {
        $rede = MatrizForcada::where('id_dados', $parameter)->first();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        // nova condição de verificação remover depois
        if ($rede) {

            $name = $rede->user->name;
            $login = $rede->user->login;
            $redename = $rede->user->name . ' ' . $rede->user->last_name ?? '';
            $id = $rede->id;
            $upline = $rede->upline;
            $qty = $rede->qty;
            $email = $rede->user->email;
            $volume = $rede->user->getVolume($rede->user->id);
            $tag = '';
            $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
            $getadessao = $rede->user->getAdessao($rede->user->id);
            $getpackages = $rede->user->getPackages($rede->user->id);

            if (!$pay) {
                $tag = ["Inactive"];
            }
            if ($getadessao > 0) {
                $tag = ["PreRegistration"];
            }
            if ($getpackages > 0) {
                $tag = ["AllCards"];
            }
            $rede_users = MatrizForcada::where('upline', $id)->get()->count();

            if ($rede_users > 0) {
                $network = $this->getNetwork($rede->id);
                $networks[] = array(
                    "id" => "$id",
                    "login" => "$login",
                    "name" => "$redename",
                    "upline" => $upline,
                    "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                    "size" => ".$qty",
                    "qty" => $qty ? $qty : 0,
                    "referred" => $name,
                    "email" => $email,
                    "volume" => "Volume: $volume",
                    "tags" => $tag,
                    "active" => $rede->user->hasValidOrderPackage($startDate, $endDate),
                    "level" => 0
                );
                $networks = array_merge($network, $networks);
            } else {
                $network = $this->getNetwork($rede->id);
                $networks = array(
                    array(
                        "id" => "$id",
                        "login" => "$login",
                        "name" => "$redename",
                        "upline" => $upline,
                        "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                        "size" => ".$qty",
                        "qty" => $qty ? $qty : 0,
                        "referred" => $name,
                        "volume" => "Volume: $volume",
                        "tags" => $tag,
                        "active" => $rede->user->hasValidOrderPackage($startDate, $endDate),
                        "level" => 0
                    )
                );
            }

            $id_user = Auth::id();
            $openProduct = OrderPackage::where('user_id', $id_user)->where('payment_status', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
            $countPackages = count($openProduct);

            usort($networks, function ($a, $b) {
                return $a['upline'] - $b['upline'];
            });
            // return response()->json($networks);
            $networks = json_encode($networks);
            // return response()->json(['qtd' => count($network)]);
            return view('network.rede', compact('networks', 'countPackages'));
        } else {
            $id_user = Auth::id();
            $openProduct = OrderPackage::where('user_id', $id_user)->where('payment_status', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
            $countPackages = count($openProduct);

            $networks = 0;

            return view('network.rede', compact('networks', 'countPackages'));
        }
    }

    public function mytreeJSON($parameter)
    {
        $user_rede_first = User::where('login', $parameter)->first();
        $rede = MatrizForcada::where('id_dados', $user_rede_first->id)->first();

        // nova condição de verificação remover depois
        if ($rede) {

            $name = $rede->user->name;
            $login = $rede->user->login;
            $redename = $rede->user->name . ' ' . $rede->user->last_name ?? '';
            $id = $rede->id;
            $upline = $rede->upline;
            $qty = $rede->qty;
            $email = $rede->user->email;
            $volume = $rede->user->getVolume($rede->user->id);
            $tag = '';
            $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
            $getadessao = $rede->user->getAdessao($rede->user->id);
            $getpackages = $rede->user->getPackages($rede->user->id);

            if (!$pay) {
                $tag = ["Inactive"];
            }
            if ($getadessao > 0) {
                $tag = ["PreRegistration"];
            }
            if ($getpackages > 0) {
                $tag = ["AllCards"];
            }
            $rede_users = MatrizForcada::where('upline', $id)->get()->count();

            if ($rede_users > 0) {
                $network = $this->getNetwork($rede->id);

                $networks[] = array(
                    "id" => "$id",
                    "login" => "$login",
                    "name" => "$redename",
                    "upline" => $upline,
                    "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                    "size" => ".$qty",
                    "qty" => $qty ? $qty : 0,
                    "referred" => $name,
                    "email" => $email,
                    "volume" => "Volume: $volume",
                    "tags" => $tag,
                    "level" => 0
                );
                $networks = array_merge($network, $networks);
            } else {
                $network = $this->getNetwork($rede->id);
                $networks = array(
                    array(
                        "id" => "$id",
                        "login" => "$login",
                        "name" => "$redename",
                        "upline" => $upline,
                        "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                        "size" => ".$qty",
                        "qty" => $qty ? $qty : 0,
                        "referred" => $name,
                        "volume" => "Volume: $volume",
                        "tags" => $tag,
                        "level" => 0
                    )
                );
            }

            $id_user = Auth::id();
            $openProduct = OrderPackage::where('user_id', $id_user)->where('payment_status', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
            $countPackages = count($openProduct);

            usort($networks, function ($a, $b) {
                return $a['upline'] - $b['upline'];
            });

            return response()->json($networks);

            $networks = json_encode($networks);
            //$networks = str_replace(array("\n", "\r"), '', $networks);
            // dd($networks);
        } else {
            $login = auth()->user()->login;
            $this->mytreeJSON($login);
        }
    }

    public function mytreediferente($parameter)
    {
        $rede = Rede::where('user_id', $parameter)->first();
        $name = empty($rede->upline_id) ? "" : Rede::find($rede->upline_id)->user->login;
        $redename = $rede->user->login;
        $id = $rede->id;
        $network = $this->getNetworkDiferente($rede->id);
        if ($network != NULL) {
            $networks['tree'] = array($id => $network['tree']);
            $networks['params'] = array(
                $id => array(
                    'trad' => $redename . ' </br>',
                    'styles' => array(
                        'font-weight' => '600',
                        'font-size' => '18px',
                        'background-color' => '#f3f3f37a',
                        'color' => 'red',
                        'box-shadow' => '0 0 4px 1px #aeaeae',
                        'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                    )
                )
            );
            $networks['params'] = $network['params'] + $networks['params'];
        } else {
            $networks['tree'] = array($id => '');
            $networks['params'] = array(
                $id => array(
                    'trad' => $redename . ' </br>',
                    'styles' => array(
                        'font-weight' => '600',
                        'font-size' => '18px',
                        'background-color' => '#f3f3f37a',
                        'color' => 'red',
                        'box-shadow' => '0 0 4px 1px #aeaeae',
                        'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                    )
                )
            );
        }

        $id_user = Auth::id();
        $openProduct = OrderPackage::where('user_id', $id_user)->where('payment_status', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        $countPackages = count($openProduct);

        $tree = json_encode($networks['tree']);
        $params = json_encode($networks['params']);
        return view('network.rede_diferente', compact('tree', 'params', 'countPackages'));
    }
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function myreferrals()
    {
        $id_user = Auth::id();
        $rede = Rede::where('user_id', $id_user)->first();

        if ($rede) {
            $networks = Rede::where('upline_id', $rede->id)->get();
        } else {
            $networks = [];
        }

        $id_user = Auth::id();
        $openProduct = OrderPackage::where('user_id', $id_user)->where('payment_status', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        $countPackages = count($openProduct);

        return view('network.myreferrals', compact('networks', 'countPackages'));
    }
    private function getNetwork($id, $cont = 1)
    {
        $rede_users = MatrizForcada::where('upline', $id)->get();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $networks = array();
        foreach ($rede_users as $rede) {
            $login = $rede->user->login;
            $redename = $rede->user->name . ' ' . $rede->user->last_name ?? '';
            $id = $rede->id;
            $qty = $rede->qty;
            $upline = $rede->upline;
            $volume = $rede->user->getVolume($rede->user->id);
            $tag = '';
            $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
            $getadessao = $rede->user->getAdessao($rede->user->id);
            $getpackages = $rede->user->getPackages($rede->user->id);
            if (!$pay) {
                $tag = ["Inactive"];
            }
            if ($getadessao > 0) {
                $tag = ["PreRegistration"];
            }
            if ($getpackages > 0) {
                $tag = ["AllCards"];
            }
            $email = $rede->user->email;
            $referral_rede = MatrizForcada::where('id', $upline)->first();
            $referral_user = User::where('id', $referral_rede->id_dados)->first();
            $level = HistoricScore::where('user_id', auth()->user()->id)->where('user_id_from', $rede->id_dados)->orderBy('id', 'desc')->first();

            $networks[] = array(
                "id" => "$id",
                "pid" => "$upline",
                "login" => "$login",
                "name" => "$redename",
                "upline" => $upline,
                "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                "size" => "$qty",
                "qty" => $qty ? $qty : 0,
                "referred" => $referral_user->login,
                "email" => $email,
                "volume" => "Volume: $volume ",
                "btn" => "<a href='" . route('networks.mytree', ['parameter' => $rede->user->id]) . "'> More + </a>",
                "tags" => $tag,
                "active" => $rede->user->hasValidOrderPackage($startDate, $endDate),
                "level" => $cont
            );
            $networks = array_merge($this->getNetwork($rede->id, $cont + 1), $networks);
        }
        //dd($networks);
        return $networks;
    }
    private function getNetworkDiferente($parameter)
    {
        $redes = Rede::where('upline_id', $parameter)->get();
        if ($redes == NULL)
            return NULL;
        $networks = array();
        foreach ($redes as $rede) {
            $redename = $rede->user->login;
            $id = $rede->id;
            $network = $this->getNetworkDiferente($rede->id);
            if ($network != NULL) {
                if (isset($networks['tree'])) {
                    $networks['tree'] = $networks['tree'] + array($id => $network['tree']);
                    $networks['params'] = $networks['params'] + array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                } else {
                    $networks['tree'] = array($id => $network['tree']);
                    $networks['params'] = array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                }
                $networks['params'] = $network['params'] + $networks['params'];
            } else {
                if (isset($networks['tree'])) {
                    $networks['tree'] = $networks['tree'] + array($id => '');
                    $networks['params'] = $networks['params'] + array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                } else {
                    $networks['tree'] = array($id => '');
                    $networks['params'] = array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('networks.mytree', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                }
            }
        }
        return $networks;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function associatesReport(Request $request)
    {
        $id_user = Auth::id();
        $rede = Rede::where('user_id', $id_user)->first();
        $networks = Rede::where('upline_id', $rede->id)->get();

        if ($networks) {
            return view('network.associatesReport', compact('networks'));
        }
    }

    public function pesquisa(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->login;
            // $rede = DB::table('rede')
            // ->selectRaw('users.login as login, users.country as country, users.email as email,users.name as name,user2.name as patrocinador,rede.id as id')
            // ->join('users', 'rede.user_id', '=', 'users.id')
            // ->join('rede rede2', 'rede2.id', '=', 'rede.upline_id')
            // ->join('users user2', 'rede2.user_id', '=', 'user2.id')
            // ->where('rede.upline_id', $id )->get();

            $rede = DB::select('SELECT users.login as login, 
                                    users.country as country, 
                                    users.email as email,
                                    users.name as name,
                                    user2.login as patrocinador,
                                    rede.id as id 
                                FROM rede
                                JOIN users on rede.user_id = users.id
                                JOIN rede rede2 on rede2.id = rede.upline_id
                                JOIN users user2 on rede2.user_id = user2.id
                                WHERE rede.upline_id = ?',
                [$id]
            );
            if (empty(sizeof($rede))) {
                return response()->json(['error' => 'tabela vazia']);
            } else {
                return response()->json($rede);
            }

        }
        return view('network.associatesReport');
    }

    public function IndicationEcomm()
    {
        $indication = EcommRegister::where("recommendation_user_id", Auth::id())->get();
        $array_user = array();

        foreach ($indication as $data) {

            $my_qv = 0;
            $qvs = PaymentOrderEcomm::where('id_user', $data->id)->where('status', 'paid')->get();

            foreach ($qvs as $payment) {
                $my_qv += DB::table('ecomm_orders')
                    ->where('number_order', $payment->number_order)
                    ->sum('qv');
            }

            $data_user = [
                'id' => $data->id,
                'name' => $data->name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'phone' => $data->phone,
                'register' => $data->created_at,
                'qv' => $my_qv,

            ];

            if (!in_array($data_user, $array_user)) {

                array_push($array_user, $data_user);
            }
        }

        return view('network.IndicationEcomm', compact('indication', 'array_user'));
    }

    public function IndicationEcommOrders($id)
    {
        $indication = EcommRegister::where("recommendation_user_id", Auth::id())
            ->where('id', $id)
            ->first();

        $ordersIds = \DB::table('ecomm_orders')
            ->select(\DB::raw('MIN(id) as id'))
            ->where('id_user', $id)
            ->groupBy('number_order')
            ->pluck('id');

        $orders = EcommOrders::whereIn('id', $ordersIds)
            ->orderBy('updated_at', 'DESC')
            ->paginate(9);

        foreach ($orders as $value) {
            $payment = PaymentOrderEcomm::where('id', $value->id_payment_order)->first();
            $value['payment'] = $payment->status;
            $value['t_qv'] = DB::table('ecomm_orders')
                ->where('number_order', $value->number_order)
                ->sum('qv');

            $value['total'] = $payment->total_price;
        }

        return view('network.IndicationEcommOrders', compact('indication', 'orders'));
    }

    public function IndicationEcommOrdersFilter($id)
    {
        $indication = EcommRegister::where("recommendation_user_id", Auth::id())
            ->where('id', $id)
            ->first();

        $ordersIds = DB::table('ecomm_orders')
            ->select(DB::raw('MIN(id) as id'))
            ->where('id_user', $id)
            ->groupBy('number_order')
            ->pluck('id');

        $orders = EcommOrders::whereIn('id', $ordersIds)
            ->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', (date('m')))
            ->orderBy('updated_at', 'DESC')
            ->paginate(9);

        foreach ($orders as $value) {
            $payment = PaymentOrderEcomm::where('id', $value->id_payment_order)->first();
            $value['payment'] = $payment->status;
            $value['total'] = $payment->total_price;
        }

        return view('network.IndicationEcommOrders', compact('indication', 'orders'));
    }

    public function IndicationEcommOrdersDetail($order)
    {
        $orderDetails = EcommOrders::where('number_order', $order)->get();

        $payment = PaymentOrderEcomm::where('id', $orderDetails[0]->id_payment_order)->first();
        $orderDetails[0]['payment'] = $payment->status;

        foreach ($orderDetails as $value) {
            $product = Propertie::where('id', $value->id_product)->first();
            // $product->images = json_decode($product->images);
            $value['name_product'] = $product->name;
            $value['image_product'] = json_decode($product->images)[0];

        }

        return view('network.IndicationEcommOrdersDetail', compact('orderDetails'));
    }

    public function mycareer()
    {
        $careers = Career::all();
        $latestCareerIds = CareerUser::selectRaw('MAX(id) as max_id')
            ->where('user_id', Auth::id())
            ->groupBy('career_id')
            ->pluck('max_id');

        $careerAchieved = CareerUser::whereIn('id', $latestCareerIds)
            ->get();

        foreach ($careers as $carreira) {
            foreach ($careerAchieved as $conquistada) {
                if ($carreira->id == $conquistada->career_id) {
                    $carreira->achieved = true;
                    $carreira->dt_achieved = $conquistada->created_at;
                }
            }
        }

        // dd($careers);
        $data_atual = date('Y-m');
        // $data_atual = "2023-09";

        $logado = Auth::id();
        $id_logado = Auth::id();
        $directs = 0;
        $sum = 0;
        $conta = 0;
        $users_lista = [];

        ####PEGA A PONTUACAO DA DATA ATUAL DAS COMPRAS DE SI PROPRIO
        // $minha_pontuacao = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(score) as pontos_ac_m FROM historic_score WHERE user_id = '{$id_logado}' AND created_at LIKE '%{$data_atual}%' and
        // level_from=0 "));

        $minha_pontuacao = DB::table('historic_score')
            ->where('user_id', $id_logado)
            ->where('level_from', 0)
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$data_atual'")
            ->sum('score');

        $PersonalVolumeExternal = 0;
        $directCustomers = DB::select("SELECT id FROM ecomm_registers WHERE recommendation_user_id = $id_logado");

        if (count($directCustomers) > 0) {
            foreach ($directCustomers as $value) {
                $idEcomm = $value->id;
                $qvEcomm = DB::select("SELECT SUM(qv) AS total FROM ecomm_orders WHERE id_user=$idEcomm AND client_backoffice = 0 AND DATE_FORMAT(created_at, '%Y-%m') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m') AND number_order IN (SELECT number_order FROM payments_order_ecomms WHERE status = 'paid')");
                $PersonalVolumeExternal += isset($qvEcomm[0]->{'total'}) ? $qvEcomm[0]->{'total'} : 0;
            }
        }

        $meus_pontos = $minha_pontuacao + $PersonalVolumeExternal;

        // $carreira_atual = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM career_users WHERE user_id = '{$id_logado}' and created_at like '%" . date('Y-m') . "%' ORDER BY career_id DESC LIMIT 1 "));
        // if ($carreira_atual['career_id'] == null) {
        //     $ordem = 1;
        // } else {
        //     $ordem = $carreira_atual['career_id'] + 1;
        // }

        $carreira_atual = CareerUser::where('user_id', $id_logado)
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$data_atual'")
            ->orderByDesc('career_id')
            ->limit(1)
            ->first();

        if (!isset($carreira_atual)) {
            $ordem = 1;
        } else {
            $ordem = $carreira_atual->career_id + 1;
        }

        // $carreiras = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM career WHERE id = '{$ordem}' "));

        $carreiras = Career::where('id', $ordem)->first();

        if (isset($carreiras)) {
            $verifica_diretos = User::where('recommendation_user_id', $id_logado)->get();

            foreach ($verifica_diretos as $array_verifica_diretos) {
                $id_indi_diretos = $array_verifica_diretos->id;


                $verifica_pontuacao_rede = DB::table('historic_score')
                    ->where('user_id', $id_indi_diretos)
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$data_atual'")
                    ->sum('score');

                if ($verifica_pontuacao_rede >= $carreiras->MaximumVolumeD) {
                    $valor_aproveitado = $carreiras->MaximumVolumeD;
                } else {
                    $valor_aproveitado = $verifica_pontuacao_rede;
                }

                if ($carreiras->bonus <= $verifica_pontuacao_rede) {
                    $directs++;
                }

                $sum += $valor_aproveitado;
                $conta++;

                $users_lista[$id_indi_diretos] = [
                    "name" => $array_verifica_diretos->name,
                    "last_name" => $array_verifica_diretos->last_name,
                    "aproveitado" => $valor_aproveitado,
                    "total" => $verifica_pontuacao_rede ?? 0,
                ];
            }

            $quantDiretos = $conta;
            $soma = $sum + $meus_pontos;
        }

        if ($ordem == 1) {
            $proximaCarreira = Career::where('id', $ordem + 1)->first();
        } else {
            $proximaCarreira = Career::where('id', $ordem)->first();
            if (!isset($proximaCarreira)) {
                $proximaCarreira = $carreira_atual;
            }
        }

        return view('network.myCareer', compact('careers', 'users_lista', 'soma', 'quantDiretos', 'meus_pontos', 'proximaCarreira', 'careerAchieved'));
    }

    public function IndicationEcommFilter(Request $request)
    {
        $date_in = str_replace("/", "-", $request->date_in);
        $date_out = str_replace("/", "-", $request->date_out);

        $indication = EcommRegister::where("recommendation_user_id", Auth::id())->get();
        $array_user = array();

        foreach ($indication as $data) {

            $file_date = $data->created_at;
            $file_date = explode(' ', $file_date);
            // $file_date = explode('-', $file_date[0]);

            $newdata = $file_date[0];

            if ($newdata >= $date_in and $newdata <= $date_out) {

                $my_qv = 0;
                $qvs = PaymentOrderEcomm::where('id_user', $data->id)->where('status', 'paid')->get();

                foreach ($qvs as $payment) {
                    $my_qv += DB::table('ecomm_orders')
                        ->where('number_order', $payment->number_order)
                        ->sum('qv');
                }

                $data_user = [
                    'id' => $data->id,
                    'name' => $data->name,
                    'last_name' => $data->last_name,

                    'email' => $data->email,
                    'phone' => $data->phone,
                    'register' => $data->created_at,
                    'qv' => $my_qv,
                ];

                if (!in_array($data_user, $array_user)) {

                    array_push($array_user, $data_user);
                }
            }
        }

        return view('network.IndicationEcomm', compact('indication', 'array_user'));
    }

    public function IndicationEcommFilterMonth()
    {
        $month_date = date('m');

        $indication = EcommRegister::where("recommendation_user_id", Auth::id())->get();
        $array_user = array();

        foreach ($indication as $data) {

            $file_date = $data->created_at;
            $file_date = explode(' ', $file_date);
            $file_date = explode('-', $file_date[0]);

            $monthdata = $file_date[1];

            if (intval($monthdata) == intval($month_date)) {

                $my_qv = 0;
                $qvs = PaymentOrderEcomm::where('id_user', $data->id)->where('status', 'paid')->get();

                foreach ($qvs as $payment) {
                    $my_qv += DB::table('ecomm_orders')
                        ->where('number_order', $payment->number_order)
                        ->sum('qv');
                }

                $data_user = [
                    'id' => $data->id,
                    'name' => $data->name,
                    'last_name' => $data->last_name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'register' => $data->created_at,
                    'qv' => $my_qv,

                ];

                if (!in_array($data_user, $array_user)) {

                    array_push($array_user, $data_user);
                }
            }
        }

        return view('network.IndicationEcomm', compact('indication', 'array_user'));
    }
}

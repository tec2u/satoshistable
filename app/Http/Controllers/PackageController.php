<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\BancoCredit;
use App\Models\CustomLog;
use App\Models\Documents;
use App\Models\Package;
use App\Models\PaymentLog;
use App\Models\TransactionBank;
use App\Models\Wallet;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\OrderPackage;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use stdClass;

class PackageController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $adesao = $user->getAdessao($user->id);


        // Buscar os projetos que possuem pacotes ativados
        $projects = Project::whereHas('packages', function ($query) {
            $query->where('activated', 1);
        })->with(['packages' => function ($query) {
            $query->where('activated', 1)->orderBy('id', 'DESC');
        }])->get();

        return view('package.produtos', compact('projects', 'user'));
    }

    public function indexActivation()
    {
        $user = User::find(Auth::id());
        $packages = Package::where('type', 'activator')->where('activated', 1)->orderBy('id', 'DESC')->paginate(9);

        return view('package.produtos', compact('packages', 'user'));
    }

    public function payWithCredit()
    {
        return view('package.pay_with_credit');
    }

    public function payOrder(Request $request)
    {
        $order = OrderPackage::find($request->order_id);
        $user =  User::with('credit')->where('id', auth()->user()->id)->first();
        if (!$order) {
            return redirect()
                ->route('packages.pay_with_credit')
                ->withErrors(['error' => 'No order found with that id']);
        }

        if ($user->totalCredit() <= $order->price) {
            return redirect()
                ->route('packages.pay_with_credit')
                ->withErrors(['error' => 'You do not have enough credits to pay for this order: ' . $user->totalCredit()]);
        }

        $paymentSuccess = BancoCredit::create([
            'user_id' => auth()->user()->id,
            'order_id' => $order->id,
            'description' => 78, //description para pedido pago adicionado coloquei o 78 no momento
            'status' => 'order_payment',
            'price' => -floatval($order->price)
        ]);

        if ($paymentSuccess) {
            $order->payment_status = 1;
            $order->status = 1;
            $order->save();
            return redirect()
                ->route('packages.pay_with_credit')
                ->with('success', 'Order paid successfully!');
        } else {
            return redirect()
                ->route('packages.pay_with_credit')
                ->withErrors(['error' => 'An error occurred while trying to pay for the order']);
        }
    }

    public function packagesActivator()
    {
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1; //verifica se ja tem adesão para liberar os outros produtos
        //$adesao = true;
        $packages = Package::orderBy('id', 'DESC')->where('activated', 1)->where('type', 'activator')->paginate(9);
        // if ($user->contact_id == NULL) {
        //     $complete_registration = "Please complete your registration to purchase:<br>";
        //     $array_att = array('last_name' => 'Last Name', 'address1' => 'Address 1', 'address2' => 'Address 2', 'postcode' => 'Postcode', 'state' => 'State', 'wallet' => 'Wallet');
        //     foreach ($user->getAttributes() as $key => $value) {
        //        if ($value == NULL && array_search($key, array('last_name', 'address1', 'address2', 'postcode', 'state', 'wallet'))) {
        //           $complete_registration .= "&nbsp;&nbsp;&bull;" . $array_att[$key] . "<br>";
        //        }
        //     }
        //     flash($complete_registration)->error();
        //  }

        return view('package.produtos', compact('packages', 'adesao', 'user'));
    }
    public function packageuserpass($packageid)
    {
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);

        return view('package.packageuserpass', compact('packages', 'adesao', 'user', 'orderpackage'));
    }
    public function packageupdatelink($packageid)
    {
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);

        return view('package.packageupdatelink', compact('packages', 'adesao', 'user', 'orderpackage'));
    }
    public function packagepay($packageid)
    {
        // if (Auth::id() == 1 || Auth::id() == 115876) {
        if (true) {
            return $this->packagepayNode($packageid);
        }

        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;
        $moedas = null;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);

        return view('package.packagepay', compact('packages', 'adesao', 'user', 'orderpackage', 'moedas'));
    }
    public function change_userpassword(Request $request, $packageid)
    {
        // dd($_POST);
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;
        $data = $request->only([
            'image'
        ]);
        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $path = public_path('images/printscreen/');
        !is_dir($path) &&
            mkdir($path, 0777, true);


        $orderpackage = OrderPackage::find($packageid);

        if (isset($request->image)) {
            if ($request->file('image')->isValid()) {
                $rules = [
                    'image' => 'image|mimes:jpeg,png,webp|max:10240',
                ];
                $validator = \Validator::make($request->all(), $rules);

                if (!$validator->fails()) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move($path, $imageName);
                    $orderpackage->printscreen = $imageName;
                } else {
                    return redirect()->back()->with('error', 'The image is invalid. Please try again.');
                }
            }
        }

        $orderpackage->user = $_POST['login_number'];
        $orderpackage->pass = $_POST['login_password'];
        $orderpackage->server = $_POST['server'];

        $orderpackage->update();

        return view('package.change_userpassword', compact('packages', 'adesao', 'user'));
    }
    public function change_link($packageid)
    {
        // dd($_POST);
        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);

        $orderpackage = OrderPackage::find($packageid);
        $orderpackage->link = $_POST['link'];
        $orderpackage->update();

        return view('package.change_link', compact('packages', 'adesao', 'user'));
    }


    public function detail($packageid)
    {

        $package = Package::where('id', '=', $packageid)
            ->first();

        $othersPackages = [];
        if ($package->type == 'activator') {
            $othersPackages = Package::where('type', '<>', 'activator')->get();
        }

        return view('package.produto', compact('package', 'othersPackages'));
    }

    public function package()
    {
        $id_user = Auth::id();
        $orderpackages = OrderPackage::orderBy('id', 'DESC')
            ->where('hide', false)
            ->where('user_id', $id_user)->paginate(9);

        $orderpackages->map(function ($orderpackage) {
            $ids = explode(',', $orderpackage->others_packages_id);
            $orderpackage->other_packages = Package::whereIn('id', $ids)->get();
            return $orderpackage;
        });

        $orderpackages->map(function ($orderpackage) {
            $orderpackage->activator_package = Package::where('id', $orderpackage->activator_id)->get();
            return $orderpackage;
        });
        return view('userpackageinfo', compact('orderpackages'));
    }
    public function packageprofit()
    {
        $id_user = Auth::id();
        $orderpackages = OrderPackage::orderBy('id', 'DESC')
            ->where('hide', false)
            ->where('package_id', 20)
            ->where('user_id', $id_user)->paginate(9);

        return view('userpackageprofitinfo', compact('orderpackages'));
    }

    public function hide($id)
    {
        try {
            $orderpackage = OrderPackage::find($id);
            $orderpackage->hide = true;
            $orderpackage->update();
            flash(__('package.your_order_has_been_hidden'))->success();
            return redirect()->back();
        } catch (Exception $e) {
            flash(__('package.unable_to_hide_your_order'))->error();
            return redirect()->back();
        }
    }

    public function payCrypto(Request $request)
    {
        // if (Auth::id() == 1 || Auth::id() == 115876) {
        if (true) {
            return $this->payCryptoNode($request);
        }


        if ($request->method != 'BTC' && $request->method != 'TRC20') {
            return redirect()->back();
        }

        /*   if (strlen($request->price) < 7) {
              $price = floatval(str_replace(',', '.', $request->price));
          } else {
              $valorSemSeparadorMilhar = str_replace('.', '', $request->price);
              $price = str_replace(',', '.', $valorSemSeparadorMilhar);
          } */

        $price = $request->price;

        $payment = $this->genUrlCrypto($price, $request->method);
        // dd($payment);
        if (isset($payment) and $payment != false) {
            $order = OrderPackage::where('id', $request->id)->first();
            $order->transaction_code = $payment->invoice_id;
            $order->payment_status = 0;
            $order->payment = "";
            $order->transaction_wallet = $payment->id;
            $order->save();
            return redirect()->away($payment->url);
        } else {
            return redirect()->back();
        }
    }

    public function genUrlCrypto($price, $method)
    {
        $name = "AI-NEXT-LEVEL";

        if ($method == 'BTC') {
            $paymentConfig = [
                "api_url" => "https://coinremitter.com/api/v3/BTC/create-invoice",
                "api_key" => '$2y$10$Jn8TvSVsYN6mSJTIK/EieOKJyTzSM6ZxXUpq/WPMsIprA2eNApc8a',
                "password" => "18102023",
                "currency" => "USD",
                "expire_time" => "60"
            ];
        } else if ($method == 'TRC20') {
            $paymentConfig = [
                "api_url" => "https://coinremitter.com/api/v3/USDTTRC20/create-invoice",
                //  "api_key" => '$2y$10$xvuOi9NUWBzpELE0he8/w.WKhTqHDuckVfkDz6/ZMR2RgVmPchWeS',
                // "password" => "AI@satoshitable23",
                "api_key" => '$2y$10$WBnWO29RL.heTCySoIYDt.vBZC07zKSH.tJpIu4gHextS7ux.8e1q',
                "password" => "RcBryv2ZQjS9S5@",
                "currency" => "USD",
                "expire_time" => "60"
            ];
        }

        $curl = curl_init();

        // $url = route('notify.payment');
        $url = "https://ai-satoshitable.com/packages/packagepay/notify";

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $paymentConfig['api_url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "api_key": "' . $paymentConfig['api_key'] . '",
                "password": "' . $paymentConfig['password'] . '",
                "amount": "' . $price . '",
                "name": "' . $name . '",
                "currency": "' . $paymentConfig['currency'] . '",
                "expire_time": "' . $paymentConfig['expire_time'] . '",
                "notify_url" : "' . $url . '"

            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $raw = json_decode(curl_exec($curl));

        // $log = new CustomLog;
        // $log->content = json_encode($raw);

        // $log->operation = "New Profit Order Pmt";

        // $log->save();

        curl_close($curl);

        // dd($raw);

        if ($raw->flag === 1) {
            return $raw->data;
        } else {
            return false;
        }
    }

    public function notify(Request $request)
    {
        $requestFormated = $request->all();

        // crypto
        if (isset($requestFormated["id"]) && !isset($requestFormated["node"])) {
            // return 'oi';

            $payment = OrderPackage::where('transaction_wallet', $requestFormated["id"])
                ->orWhere('transaction_wallet', $requestFormated["merchant_id"])
                // ->orWhere('id', $requestFormated["id_order"])
                ->first();

            if (!isset($payment)) {
                return response("Not found", 404);
            }

            if (strtolower($requestFormated["status"]) == 'paid' || strtolower($requestFormated["status"]) == 'over paid') {
                $payment->payment_status = 1;
                $payment->payment = $requestFormated["status"];
                $payment->status = 1;
            }

            if (strtolower($requestFormated["status"]) == 'cancelled' || strtolower($requestFormated["status"]) == 'expired') {
                $payment->payment_status = 2;
                $payment->payment = $requestFormated["status"];
                $payment->status = 0;
            }

            $payment->save();


            $log = new PaymentLog;
            $log->content = $requestFormated["status"];
            $log->order_package_id = $payment->id;
            $log->operation = "payment package";
            $log->controller = "packageController";
            $log->http_code = "200";
            $log->route = "/packages/packagepay/notify";
            $log->status = "success";
            $log->json = json_encode($request->all());
            $log->save();

            if ($payment->package_id == 20 && strtolower($requestFormated["status"]) == 'paid' || strtolower($requestFormated["status"]) == 'over paid') {
                $this->sendPostPayOrder($payment->id);
            }
        } else if (isset($requestFormated["node"])) {
            // return 'node';
            $payment = OrderPackage::where('transaction_wallet', $requestFormated["id"])
                ->orWhere('transaction_wallet', $requestFormated["merchant_id"])
                ->Where('id', $requestFormated["id_order"])
                ->first();

            if (!isset($payment) || $payment->id != $requestFormated["id_order"]) {
                return response("Not found", 404);
            }

            if (
                strtolower($requestFormated["status"]) == 'paid'
                || strtolower($requestFormated["status"]) == 'overpaid'
                || strtolower($requestFormated["status"]) == 'underpaid'
            ) {
                $payment->payment = $requestFormated["status"];
                $payment->payment_status = 1;
                $payment->status = 1;
            }

            if (strtolower($requestFormated["status"]) == 'cancelled' || strtolower($requestFormated["status"]) == 'expired') {
                $payment->payment = $requestFormated["status"];
                $payment->payment_status = 2;
                $payment->status = 0;
            }

            $payment->save();

            if ($payment->package_id == 20 && strtolower($requestFormated["status"]) == 'paid' || strtolower($requestFormated["status"]) == 'overpaid') {
                // $this->sendPostPayOrder($payment->id);
            }

            $log = new PaymentLog;
            $log->content = $requestFormated["status"];
            $log->order_package_id = $payment->id;
            $log->operation = "payment package";
            $log->controller = "packageController";
            $log->http_code = "200";
            $log->route = "/packages/packagepay/notify";
            $log->status = "success";
            $log->json = json_encode($request->all());
            $log->save();
        }

        if (isset($requestFormated["teste"])) {
            if (isset($requestFormated["idpedido"])) {
                $payment = OrderPackage::where('id', $requestFormated["idpedido"])->first();
                return response()->json($payment);
            } else {
                $payment = OrderPackage::where('payment_status', 1)->latest()->first();
                return response()->json($payment);
            }
        }

        // return 'alo';

        return response("OK", 200);
    }

    public function packagepayNode($packageid)
    {
        $packages = Package::orderBy('id', 'DESC')->where('id', $packageid);
        $orderpackage = OrderPackage::find($packageid);

        $user = User::find(Auth::id());
        $adesao = !$user->getAdessao($user->id) >= 1;

        $banks = TransactionBank::where('activated', 1)->get();


        return view('package.packagepay', compact('packages', 'adesao', 'user', 'orderpackage', 'banks'));
    }

    public function genUrlCryptoNode($method, $order)
    {

        $paymentConfig = [
            // "api_url" => "http://127.0.0.1:8001/packages/wallets/notify"
            "api_url" => "https://binfinitycrypto.tecnologia2u.com.br/packages/wallets/notify"
        ];

        $curl = curl_init();

        $url = "http://127.0.0.1:8000/packages/packagepay/notify";
        // $url = "https://sunvolt.pro/api/notify";

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $paymentConfig['api_url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "id_order": "' . $order->id . '",
                "price": "' . $order->price . '",
                "price_crypto": "' . $order->price_crypto . '",
                "login": "' . "dataseek@gmail.com" . '",
                "password": "' . "password" . '",
                "coin": "' . $method . '",
                "notify_url" : "' . $url . '"

            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $raw = json_decode(curl_exec($curl));

        curl_close($curl);
        if ($raw) {
            return $raw;
        } else {
            return false;
        }
    }


    public function sendPostPayOrder($id_order)
    {

        $client = new Client();
        $Orderpackage = OrderPackage::where('id', $id_order)->first();

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json'
        ];

        $data = [
            "type" => "bonificacao",
            "param" => "GeraBonusPedidoInterno",
            "idpedido" => "$id_order",
            "prod" => 1
        ];

        $url = 'https://ai-satoshitable.com/public/compensacao/bonificacao.php';

        try {
            $resposta = $client->post($url, [
                'form_params' => $data,
                // 'headers' => $headers,

            ]);

            $statusCode = $resposta->getStatusCode();
            $body = $resposta->getBody()->getContents();

            parse_str($body, $responseData);

            $log = new CustomLog;
            $log->content = json_encode($responseData);
            $log->user_id = $Orderpackage->user_id;
            $log->operation = $data['type'] . "/" . $data['param'] . "/" . $data['idpedido'];
            $log->controller = "app/controller/admin/PackageAdminController";
            $log->http_code = 200;
            $log->route = "payd order";
            $log->status = "SUCCESS";
            $log->save();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function invoice($id)
    {
        if (!$id) {
            abort(404);
        }

        $order = OrderPackage::where('id', $id)->where('package_id', 20)->first();

        if (!$order) {
            abort(404);
        }

        if ($order->payment_status != 1) {
            abort(404);
        }

        // dd($order);

        $id_user = $order->user_id;
        $user = User::where('id', '=', $id_user)->first();
        // dd($user);

        $data = [
            'client_name' => $user->name . ' ' . $user->last_name ?? '',
            'client_email' => $user->email,
            'client_tel' => $user->cell ?? '',
            'package_name' => $order->reference,
            'package_price' => $order->price,
            'order_id' => $order->id
        ];

        return view('pdf.orderslipProduct', compact('data'));
    }

    public function processBuying()
    {
        return view('processBuying.form');
    }

    public function processBuyingCreate(Request $request)
    {
        // dd($request);
        $id_package = $request->package_id;

        $package = Package::where('id', $id_package)->first();

        $user = User::find(Auth::id());

        $path = public_path('images/printscreen/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        if (isset($request->image)) {
            if ($request->file('image')->isValid()) {
                $rules = [
                    'image' => 'file|mimes:jpeg,jpg,png,webp,doc,docx,pdf|max:10240',
                ];
                $validator = \Validator::make($request->all(), $rules);

                if (!$validator->fails()) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move($path, $imageName);
                } else {
                    return redirect()->back()->with('error', 'The image is invalid. Please try again.');
                }
            }
        }

        $newOrder = new OrderPackage;
        $newOrder->user_id = $user->id;
        $newOrder->reference = $package->name;
        $newOrder->payment_status = 0;
        $newOrder->transaction_code = 0;
        $newOrder->package_id = $package->id;
        $newOrder->price = $package->price;
        $newOrder->amount = 1;
        $newOrder->transaction_wallet = 0;
        $newOrder->wallet = 0;
        $adesao = !$user->getAdessao($user->id) >= 1;
        $newOrder->printscreen = $imageName ?? '';
        $newOrder->pass = $request->login_password;
        $newOrder->server = $request->server_address;
        $newOrder->user = $request->login_number;
        $newOrder->save();

        return redirect()->route('packages.packagelog')->with('success', '');
    }

    public function baixaPdf($nome)
    {
        $docs = Documents::all();

        foreach ($docs as $item) {
            $texto = $item->title;
            if (strpos($texto, '|') !== false) {
                $partes = explode('|', $texto);
                $palavraAntesDoPipe = $partes[0];
                if ($palavraAntesDoPipe == $nome) {
                    $file = storage_path("app/public/{$item->path}");
                    if (file_exists($file)) {
                        $headers = [
                            'Content-Type' => 'application/pdf',
                        ];
                        $fileName = "$nome.pdf";

                        return response()->download($file, $fileName, $headers);
                    } else {
                        abort(404);
                    }
                }
            }
        }

        abort(404);
    }

    function filterWallet($mt) {}

    public function payCryptoNode(Request $request)
    {
        $order = OrderPackage::where('id', $request->id)->first();

        if ($request->method === 'bonus') {
            $availableComission = Banco::where('user_id', auth()->user()->id)->sum('price');

            if ($availableComission >= $order->price) {
                $order->payment_status = 1;
                $order->status = 1;
                $order->save();
            } else {
                return redirect()->back()->withErrors(['error' => "You do not have enough bonus balance to pay for this package."]);
            }
        }
        return response()->json($request);

        if (isset($request->retry) && $request->retry == 1) {
            $rorder = OrderPackage::where('id', $request->id)->first();
            $rorder->payment_status = 0;
            $rorder->status = 0;
            $rorder->wallet = null;
            $rorder->price_crypto = null;
            $rorder->save();
        }

        // dd($request);

        if (strlen($request->price) < 7) {
            $price = floatval(str_replace(',', '.', $request->price));
        } else {
            $valorSemSeparadorMilhar = str_replace('.', '', $request->price);
            $price = str_replace(',', '.', $valorSemSeparadorMilhar);
        }

        $price = $request->price;

        $order->price_crypto = str_replace(",", "", $request->{$request->method});
        $order->save();
        // dd($order);
        $postNode = $this->genUrlCryptoNode($request->method, $order);

        if (!$postNode && !isset($postNode->wallet)) {
            // dd($postNode);
            $orderReset = OrderPackage::where('id', $request->id)->first();
            $orderReset->price_crypto = null;
            $orderReset->wallet = null;
            $orderReset->save();

            return redirect()->back();
        }

        $order = OrderPackage::where('id', $request->id)->first();
        $order->wallet = $postNode->wallet;
        $order->transaction_code = $request->method;
        $order->transaction_wallet = $postNode->merchant_id;
        $order->save();
        // }


        return redirect()->back();

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ClubSwanController;
use App\Http\Requests\Admin\SearchRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoricScoreController;
use App\Http\Controllers\MatrizForcadaController;
use App\Models\Banco;
use App\Models\BancoCredit;
use App\Models\ConfigBonus;
use App\Models\ConfigBonusunilevel;
use App\Models\CustomLog;
use App\Models\HistoricScore;
use App\Models\MatrizForcada;
use App\Models\Order;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\Rede;
use App\Models\User;
use App\Traits\CustomLogTrait;
use App\Traits\OrderBonusTrait;
use App\Traits\PaymentLogTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class PackageAdminController extends Controller
{
    use CustomLogTrait, PaymentLogTrait, OrderBonusTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::orderBy('id', 'DESC')->paginate(9);

        return view('admin.packages.packages', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::get();
        return view('admin.packages.create', compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'price',
            'commission',
            'activated',
            'type',
            'long_description',
            'description_fees',
            'plan_id',
        ]);

        if ($request->type == 'kit') {
            $data['kit'] = implode(",", $request->kit);
        }

        // try {

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName(); // Gera um nome único
            $request->file('image')->move(public_path('admin/package'), $imageName);

            // Salva o caminho no banco de dados
            $data['img'] = 'admin/package/' . $imageName;
        }


        $package = Package::create($data);

        $this->createLog('Package created successfully', 201, 'success', auth()->user()->id);
        flash(__('admin_alert.pkgcreate'))->success();
        return redirect()->route('admin.packages.index');
        // } catch (Exception $e) {
        //     $this->errorCatch($e->getMessage(), auth()->user()->id);
        //     flash(__('admin_alert.pkgnotcreate'))->error();
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);

        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $data = $request->only([
                'name',
                'price',
                'commission',
                'activated',
                'type',
                'long_description',
                'description_fees',
                'plan_id'
            ]);

            $package = package::find($id);

            if ($request->hasFile('image')) {
                // Exclui a imagem antiga, se existir
                if ($package->img && file_exists(public_path($package->img))) {
                    unlink(public_path($package->img));
                }

                // Gera um novo nome e move o arquivo
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('admin/package'), $imageName);

                // Salva o caminho da nova imagem no banco de dados
                $data['img'] = 'admin/package/' . $imageName;
            }

            $package->update($data);

            $this->createLog('Package updated successfully', 200, 'success', auth()->user()->id);
            flash(__('admin_alert.pkgupdate'))->success();
            return redirect()->route('admin.packages.index');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.pkgnotupdate'))->error();
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderupdate(Request $request, $id)
    {
        // dd($request);

        try {

            $status = $request->get('status');
            $payment_status = $request->get('payment_status');
            $data = [
                "status" => $status,
                "payment_status" => $payment_status
            ];

            $Orderpackage = OrderPackage::find($id);


            if ($Orderpackage->others_packages_id && ($status == 1 && $payment_status == 1)) {
                $otherPackagesIDs = explode(",", $Orderpackage->others_packages_id);
                $otherPackages = Package::whereIn('id', $otherPackagesIDs)->get();
                $activatorPackage = Package::find($Orderpackage->activator_id);

                OrderPackage::create([
                    "user_id" => $Orderpackage->user_id,
                    "reference" => $activatorPackage->name,
                    "payment_status" => 1,
                    "status" => 1,
                    "transaction_code" => 0,
                    "package_id" => $activatorPackage->id,
                    "price" => $activatorPackage->price,
                    "amount" => 1,
                    "transaction_wallet" => 0,
                    "wallet" => 0,
                    "server" => ''
                ]);

                foreach ($otherPackages as $otherPackage) {
                    OrderPackage::create([
                        "user_id" => $Orderpackage->user_id,
                        "reference" => $otherPackage->name,
                        "payment_status" => 1,
                        "status" => 1,
                        "transaction_code" => 0,
                        "package_id" => $otherPackage->id,
                        "price" => $otherPackage->price,
                        "amount" => 1,
                        "transaction_wallet" => 0,
                        "wallet" => 0,
                        "server" => ''
                    ]);
                }

                $Orderpackage->delete();
            } else {
                $Orderpackage->update($data);

                $bonusTotal = $Orderpackage->price * 0.005;

                if ($Orderpackage->status == 1 && $Orderpackage->payment_status == 1) {
                    $userrec = User::find($Orderpackage->user_id);
                    $pontosController = new HistoricScoreController();
                    $pontosController->insertScoreToUpLevel($userrec->recommendation_user_id, 1, $userrec->id, 1000);
                    $config_unilevel = ConfigBonusunilevel::get();

                    foreach ($config_unilevel as $config) {
                        $valor = ($config->value_percent / 100) * $bonusTotal;
                        $check_ja_existe = Banco::where('user_id', $userrec->recommendation_user_id)->where('order_id', $Orderpackage->id)->count();

                        if ($check_ja_existe <= 0) {
                            if ($config->status == 1) {
                                if ($userrec->recommendation_user_id) {
                                    $rede = Rede::where('user_id', $userrec->recommendation_user_id)->first();
                                    if ($rede->qty >= $config->minimum_users) {
                                        $data = [
                                            "price" => $valor,
                                            "status" => 1,
                                            "description" => 1,
                                            "user_id" => $userrec->recommendation_user_id,
                                            "order_id" => $Orderpackage->id,
                                            "level_from" => $config->level,
                                        ];
                                        Banco::create($data);
                                    }
                                } else {
                                    break;
                                }
                            }
                        }
                        $userrec = User::find($userrec->recommendation_user_id);
                    }
                }
            }

            // $this->createLog('OrderPackage updated successfully', 200, 'success', auth()->user()->id);
            flash(__('admin_alert.pkgupdate'))->success();
            return redirect()->route('admin.packages.orderPackages');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.orderpkgnotupdate'))->error();
            dd($e->getMessage());
            return redirect()->route('admin.packages.orderPackages');
        }
    }

    public function payall() {}

    static public function orderUpdateKYC() {}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $package = Package::find($id);
            $package->activated = false;

            $package->update();
            $this->createLog('Package removed successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.pkgremove'))->success();
            return redirect()->route('admin.packages.index');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.pkgnotremove'))->error();
            return redirect()->back();
        }
    }

    public function packageFilter($parameter)
    {
        try {
            $packageSearch = Package::orderBy('id', 'DESC');

            //Filters
            switch ($parameter) {
                case 'activated':
                    $packageSearch->where('activated', true);
                    break;
                case 'desactivated':
                    $packageSearch->where('activated', false);
                    break;
            }

            $packages = $packageSearch->paginate(9);
            return view('admin.packages.packages', compact('packages'));
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.pkgnotfound'))->error();
            return redirect()->back();
        }
    }

    public function search(SearchRequest $request)
    {
        try {
            $data = $request->search;
            $packages = Package::where('name', 'like', '%' . $data . '%')->paginate(9);
            flash(__('admin_alert.pkgfound'))->success();
            return view('admin.packages.packages', compact('packages'));
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.pkgnotfound'))->error();
            return redirect()->back();
        }
    }

    public function orderPackages(Request $request)
    {
        $orderpackagesQuery = OrderPackage::with('user') ->orderBy('id', 'DESC');
        $search = $request->search ?? null;
        $fdate = $request->fdate ?? null;
        $sdate = $request->sdate ?? null;

        if($search) {
            $orderpackagesQuery->whereHas('user', function ($query) use ($search) {
                $query->where('login', $search);
            })->orWhere('id', $search);
        }

        if($fdate) {
            $orderpackagesQuery->where('created_at', '>=', $fdate . " 00:00:00");
        }

        if($sdate) {
            $orderpackagesQuery->where('created_at', '<=', $sdate ." 23:59:59");
        }

        $orderpackages = $orderpackagesQuery->paginate(9);

        $orderpackages->getCollection()->transform(function ($orderpackage) {
            $orderpackage->total_credit = $orderpackage->user
                ? $orderpackage->user->credit()->sum('price')
                : 0;
            return $orderpackage;
        });
        return view('admin.packages.orders', compact('orderpackages', 'search', 'fdate', 'sdate'));
    }

    public function deleteOrderPackage(Request $request)
    {
        $orderpackage = OrderPackage::find($request->id);

        if ($orderpackage) {
            $path = public_path('images/printscreen/');
            if (isset($orderpackage->printscreen) && $orderpackage->printscreen != '') {

                $imageName = $orderpackage->printscreen;
                $existingImagePath = $path . $imageName;

                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }

            $orderpackage->delete();

            return redirect()->back()->with('success', 'Order package deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Order package not found.');
        }
    }
    public function orderProfit()
    {
        $orderpackages = OrderPackage::select(
            DB::raw('orders_package.id as id'),
            DB::raw('orders_package.created_at as created_at'),
            DB::raw('users.name as name'),
            DB::raw('users.login as login'),
            DB::raw('orders_package.user as user'),
            DB::raw('orders_package.price as price'),
            DB::raw('orders_package.reference as reference'),
            DB::raw('orders_package.printscreen as printscreen'),
            DB::raw('orders_package.link as link'),
            DB::raw('orders_package.server as server'),
            DB::raw('orders_package.updated_at as updated_at'),
            DB::raw('orders_package.pass as pass'),
            DB::raw('orders_package.status as status')
        )
            ->orderBy('orders_package.id', 'DESC')
            ->where('package_id', 20)
            ->join('users', 'users.id', '=', 'orders_package.user_id')
            ->paginate(50);

        return view('admin.packages.ordersprofit', compact('orderpackages'));
    }
    public function searchOrders(SearchRequest $request)
    {

        try {

            $data = $request->search;
            // dd($data);
            $orderpackages = DB::table('orders_package')
                ->selectRaw('*, orders_package.id as id, orders_package.price as price')
                ->join('users', 'orders_package.user_id', '=', 'users.id')
                ->join('packages', 'orders_package.package_id', '=', 'packages.id')
                ->where(function ($query) use ($data) {
                    $query->where('users.name', 'like', '%' . $data . '%')
                        ->orWhere('users.login', 'like', '%' . $data . '%')
                        ->orWhere('orders_package.id', 'like', '%' . $data . '%')
                        ->orWhere('users.nickname', 'like', '%' . $data . '%');
                })
                ->orderBy('orders_package.id', 'DESC')
                ->paginate(50);

            foreach ($orderpackages as $order) {
                $user = User::where('id', $order->user_id)->first();
                $order->name = $user->name;
            }

            flash(__('admin_alert.userfound'))->success();
            return view('admin.packages.orders', compact('orderpackages'));
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.usernotfound'))->error();
            return redirect()->back();
        }
    }

    public function getDateOrders(Request $request)
    {

        $fdate = $request->get('fdate') . " 00:00:00";
        $sdate = $request->get('sdate') . " 23:59:59";

        $orderpackages = OrderPackage::where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->paginate(9);

        return view('admin.packages.orders', compact('orderpackages'));
    }

    public function orderfilter($parameter)
    {
        try {
            $packageSearch = OrderPackage::orderBy('id', 'DESC');

            //Filters
            switch ($parameter) {
                case 'paid':
                    $packageSearch->where('payment_status', 1);
                    break;
                case 'send':
                    $packageSearch->where('status', 0);
                    break;
                case 'canceled':
                    $packageSearch->where('status', 2);
                    break;
            }

            $orderpackages = $packageSearch->paginate(9);
            return view('admin.packages.orders', compact('orderpackages'));
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.pkgnotfound'))->error();
            return redirect()->route('admin.packages.orderPackages');
        }
    }
    public function sendPostPayOrder($id_order)
    {
        $client = new \GuzzleHttp\Client();
        $Orderpackage = OrderPackage::find($id_order);

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
            $log->route = "payd order by admin";
            $log->status = "SUCCESS";
            $log->save();
        } catch (\Throwable $th) {
            return false;
        }
    }
}

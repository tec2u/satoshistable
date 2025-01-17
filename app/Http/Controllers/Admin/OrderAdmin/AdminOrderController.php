<?php

namespace App\Http\Controllers\Admin\OrderAdmin;

use App\Http\Controllers\Controller;
use App\Models\BancoCredit;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.order-admin.index', compact('packages'));
    }

    public function addCredit(Request $request)
    {
        $membersWithCreditQuery = User::with('bancoCredit');
        $login = $request->login ?? '';
        if ($request->login) {
            $membersWithCreditQuery->where('name', 'like', "%$request->login%")->orWhere('login', $request->login);
        }
        $membersWithCredit = $membersWithCreditQuery->paginate(15);
        foreach ($membersWithCredit as $member) {
            $member->total_credit = $member->bancoCredit->sum('price');
        }
        // return response()->json($membersWithCredit);
        return view('admin.members.membersCredit', compact('membersWithCredit', 'login'));
    }


    public function payment(Request $request)
    {
        // Buscar o usuário pelo username ou email
        $user = User::orwhere("login", $request->username)
            ->orWhere('email', $request->username)->first();

        // Se o usuário não for encontrado, redireciona com uma mensagem de erro
        if (!$user) {
            flash(__('User not found'))->error(); // Mensagem de erro
            return redirect()->back();
        }

        $id_user = $user->id;
        $package = Package::find($request->package);

        // Verificar se foi fornecido um novo preço
        if (isset($request->price_new)) {
            if ($request->price_new >= $package->price) {
                $price = $request->price_new;
            } else {
                $price = $package->price;
            }
        } else {
            $price = $package->price;
        }

        try {
            // Criar o pedido
            $codepayment = "---";
            $invoiceid = "---";
            $wallet_OP = "---";

            $this->createOrder($id_user, $package, $codepayment, $invoiceid, $wallet_OP, '0', $price);

            // Mensagem de sucesso após criar o pedido
            flash(__('Order created successfully'))->success();
            return redirect('/admin/packages/orderPackages');
        } catch (\Exception $e) {
            // Em caso de erro, redirecionar de volta com a mensagem de erro
            flash(__('An error occurred: ') . $e->getMessage())->error();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function createOrder($id_user, $package, $payment, $invoiceid, $wallet, $subId, $price)
    {
        $user = User::find($id_user);

        $user->orderPackage()->create([
            "reference" => $package->name,
            "payment_status" => 0,
            "transaction_code" => $payment,
            "package_id" => $package->id,
            "price" => $price,
            "amount" => 1,
            "transaction_wallet" => $invoiceid,
            "wallet" => $wallet,
            "subscription_id" => $subId
        ]);
    }
}

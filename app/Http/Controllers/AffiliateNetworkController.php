<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rede;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Banco;
use App\Models\HistoricScore;
use App\Models\OrderPackage;
use Carbon\Carbon;

class AffiliateNetworkController extends Controller
{
    public function myAffiliateLinks()
    {
        return view('affiliate-network.MyAffiliateLinks');
    }

    public function theProgramm()
    {
        return view('affiliate-network.TheProgramm');
    }

    public function transactions()
    {
        $id_user = Auth::id();

        $transactions = User::find($id_user)->banco()->where('description', '<>', 3)->orderBy('id', 'desc')->paginate(9);

        // dd($transactions);

        return view('report.transaction', compact('transactions'));
    }




    public function binary($id_user = null)
    {
        // Exemplo de estrutura de nó:
        // {
        //     id: 3,
        //     pid: 1,
        //     "Employee Name": "Caden Ellison",
        //     Title: "Dev Manager",
        //     Photo: "https://cdn.balkan.app/shared/4.jpg"
        // }

        $id_user ??= Auth::id();
        $rede = Rede::with('user')->where('user_id', $id_user)->first();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $networks = [];
        $redename = $rede->user->name . ' ' . $rede->user->last_name ?? '';
        $network = $this->getNetwork($rede->id);
        $networks[] = array(
            "id" => $rede->user_id,
            "login" => $rede->user->login,
            "name" => $redename,
            "pid" => $rede->upline_id,
            "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
            "size" => ".".$rede->qty,
            "qty" => $rede->qty ? $rede->qty : 0,
            "referred" => $rede->user->name,
            "email" => $rede->user->email,
            "volume" => "Volume: 0",
            "tags" => '',
            "active" => $rede->user->hasValidOrderPackage($startDate, $endDate),
            "level" => 0
        );
        $networks = array_merge($network, $networks);

        // return response()->json(['count' => count($networks)]);
        $networks = count($networks) > 0 ? json_encode($networks) : [];

        return view('network.binary', compact('networks'));
    }

    private function getNetwork($id, $cont = 1)
    {
        $rede_users = Rede::with('user')->where('upline_id', $id)->get();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $networks = array();
        if ($cont >= 5) {
            return [];
        }
        foreach ($rede_users as $rede) {
            $login = $rede->user->login;
            $redename = $rede->user->name . ' ' . $rede->user->last_name ?? '';
            $id = $rede->id;
            $qty = $rede->qty;
            $upline = $rede->upline_id;
            $volume = 0;
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
            $referral_rede = Rede::where('id', $upline)->first();
            $referral_user = User::where('id', $referral_rede->user_id)->first();

            $networks[] = array(
                "id" => "$id",
                "pid" => "$upline",
                "login" => "$login",
                "name" => "$redename",
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
        return $networks;
    }

}

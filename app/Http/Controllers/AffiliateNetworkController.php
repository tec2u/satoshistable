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
        $rede = Rede::where('user_id', $id_user)->first();
        $networks = [];

        // Função recursiva para buscar diretos e indiretos
        $fetchNetwork = function ($id_user, $parent_id = null) use (&$fetchNetwork) {
            $results = [];
            $user = User::find($id_user);

            if ($user) {
                $results[] = array(
                    "id" => $id_user,
                    "pid" => $parent_id,
                    "login" => $user->login,
                    "email" => $user->email,
                    "Name" => $user->login,
                    "Photo" => asset("/assetsWelcome/images/user.png"),
                    "Title" => $user->name,
                    "tags" => ["profile"]
                );

                $rede = Rede::where('upline_id', Rede::where('user_id', $id_user)->value('id'))->get();

                foreach ($rede as $value) {
                    $results = array_merge($results, $fetchNetwork($value->user_id, $id_user));
                }
            }

            return $results;
        };

        // Buscar toda a rede a partir do usuário principal
        $networks = $fetchNetwork($id_user);
        $networks = count($networks) > 0 ? json_encode($networks) : [];

        return view('network.binary', compact('networks'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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




    public function binary($userId = null)
    {
        $userId = $userId ?? Auth::id();

        // SQL pega usuario e rede binaria
        $fetchUserAndImage = function ($userId) {
            $user = DB::table('users')
                ->join('binary_network', 'binary_network.user_id', '=', 'users.id')
                ->where('binary_network.user_id', $userId)
                ->select('users.id', 'users.login', 'users.qty_total_left', 'users.qty_total_right', 'binary_network.l_u', 'binary_network.r_u')
                ->first();

            $imageUrl = !empty($user) && !empty($user->login)
                ? 'https://cdn-icons-png.flaticon.com/512/1144/1144709.png'
                : 'https://cdn-icons-png.flaticon.com/512/149/149071.png';

            return ['user' => $user, 'image' => $imageUrl];
        };



        $total_left = HistoricScore::select(DB::raw('SUM(score) as total'))
            ->where('leg', 'L')
            ->where('status', 1)
            ->where('user_id', $userId)
            ->first();
        $total_right = HistoricScore::select(DB::raw('SUM(score) as total'))
            ->where('leg', 'R')
            ->where('status', 1)
            ->where('user_id', $userId)
            ->first();
        $total_earned = Banco::select(DB::raw('SUM(price) as total'))
            ->where('user_id', $userId)
            ->where('description', 1)
            ->first();

        // Linha 1
        $l1 = $fetchUserAndImage($userId);

        // Linha 2
        $l2p1 = $fetchUserAndImage($l1['user']->l_u ?? null);
        $l2p2 = $fetchUserAndImage($l1['user']->r_u ?? null);

        //dd($l1['user']->r_u );

        // Linha 3
        $l3p1 = $fetchUserAndImage($l2p1['user']->l_u ?? null);
        $l3p2 = $fetchUserAndImage($l2p1['user']->r_u ?? null);
        $l3p3 = $fetchUserAndImage($l2p2['user']->l_u ?? null);
        $l3p4 = $fetchUserAndImage($l2p2['user']->r_u ?? null);

        // Linha 4
        $l4p1 = $fetchUserAndImage($l3p1['user']->l_u ?? null);
        $l4p2 = $fetchUserAndImage($l3p1['user']->r_u ?? null);
        $l4p3 = $fetchUserAndImage($l3p2['user']->l_u ?? null);
        $l4p4 = $fetchUserAndImage($l3p2['user']->r_u ?? null);
        $l4p5 = $fetchUserAndImage($l3p3['user']->l_u ?? null);
        $l4p6 = $fetchUserAndImage($l3p3['user']->r_u ?? null);
        $l4p7 = $fetchUserAndImage($l3p4['user']->l_u ?? null);
        $l4p8 = $fetchUserAndImage($l3p4['user']->r_u ?? null);


        return view('network.binary', compact('l1', 'l2p1', 'l2p2', 'l3p1', 'l3p2', 'l3p3', 'l3p4', 'l4p1', 'l4p2', 'l4p3', 'l4p4', 'l4p5', 'l4p6', 'l4p7', 'l4p8', 'total_left', 'total_right', 'total_earned'));


    }
}

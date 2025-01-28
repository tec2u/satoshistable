<?php

namespace App\Http\Controllers;

use App\Models\HistoricScore as Score;
use App\Models\HistoricScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoricScoreController extends Controller
{

    public function index()
    {
        $id_user = Auth::id();
        $scores = DB::table('historic_score')
            ->join('users', 'historic_score.user_id', '=', 'users.id')
            ->select(
                'users.name as user_name',
                'historic_score.score',
                'historic_score.orders_package_id',
                'historic_score.description',
                'historic_score.created_at'
            )->whereIn('historic_score.user_id', [Auth::id()])->get();

        return view('signup_commission', compact('scores'));
    }


    function insertScoreToUpLevel($id, $level_from = 1, $user_id_level_0, $pontos)
    {
        $user = User::find($id);
        HistoricScore::create([
            'user_id' => $id,
            'description' => 'Contador',
            'score' => 0,
            'status' => 1,
            'orders_package_id' => 0,
            'level_from' => $level_from,
            'user_id_from' => $user_id_level_0,
        ]);

        if ($user->recommendation_user_id) {
            $level_from++;
            $this->insertScoreToUpLevel($user->recommendation_user_id, $level_from, $user_id_level_0, $pontos);
        }
    }
}

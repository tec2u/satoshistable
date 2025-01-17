<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banco;
use App\Models\DailyPercentage;
use App\Models\OrderPackage;

class CompensationController extends Controller
{
    public function dailyCompensation($id)
    {
        $user = User::find($id);

        $investment = OrderPackage::where('user_id', $id)->where('status', 1)->where('payment_status', 1)->sum('price');

        $daily_percentage = DailyPercentage::where('user_id', $id)->where('status', 1)->whereBetween('date_save', [date('Y-m-01'), date('Y-m-t')])->orderBy('id', 'desc')->first();

        if ($daily_percentage == null) {
            $daily_percentage = DailyPercentage::where('user_id', $id)->where('status', 1)->orderBy('id', 'desc')->first();
        }

        if ($daily_percentage == null) {
            $daily_percentage = json_decode(json_encode(array('value_perc' => 0.005)));
        }

        if ($investment > 0) {
            $data = [
                "user_id" => $user->id,
                "order_id" => 0,
                "description" => 2,
                "price" => ($investment * $daily_percentage->value_perc),
                "status" => 1,
                "level_from" => 0
            ];
            Banco::create($data);
        }
    }

    static function dailyCron()
    {
        $users = User::where('id', 260)->get();
        $count = 0;
        foreach ($users as $user) {
            if ($user->verifyAlredyPayBonusToday()) {
              CompensationController::dailyCompensation($user->id);
              if ($count >= 3) {
                break;
              }
              $count++;
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banco;
use App\Models\DailyPercentage;
use App\Models\OrderPackage;
use Carbon\Carbon;

class CompensationController extends Controller
{
    public function dailyCompensation($id, $date = null)
    {
        $user = User::find($id);

        $investmentQuery = OrderPackage::where('user_id', $id)->where('status', 1)->where('payment_status', 1);

        if ($date) {
            $investmentQuery->whereDate('created_at', '<=', $date);
        }

        $investment = $investmentQuery->sum('price');

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
            $response = Banco::create($data);
            return $response;
        }

        return false;
    }

    public function dailyCron()
    {
        $users = User::get();
        foreach ($users as $user) {
            if ($user->verifyAlredyPayBonusToday()) {
                $compensation = new CompensationController();
                $compensation->dailyCompensation($user->id);
            }
        }
    }

    public function monthlyCronSynchronize()
    {
        $users = User::get(); // Obtém todos os usuários
        $startOfMonth = Carbon::now()->startOfMonth(); // Primeiro dia do mês
        $today = Carbon::now(); // Data atual

        foreach ($users as $user) {
            // Iterar sobre cada dia do mês até hoje
            for ($date = $startOfMonth; $date <= $today; $date->addDay()) {
                if ($user->verifyAlredyPayBonusSpecificDay($date)) {
                    $compensation = new CompensationController();
                    $compensation->dailyCompensation($user->id, $date);
                }
            }
        }
    }
}

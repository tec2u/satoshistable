<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banco;
use App\Models\DailyPercentage;
use App\Models\OrderPackage;
use Illuminate\Support\Carbon;

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

        $daily_percentage_extra = Banco::where('user_id', $id)->where('status', 1)->where('description', 1)->sum('price');

        if ($investment > 0) {
            $data = [
                "user_id" => $user->id,
                "order_id" => 0,
                "description" => 2,
                "price" => (($investment * $daily_percentage->value_perc)+$daily_percentage_extra),
                "status" => 1,
                "level_from" => 0,
            ];
            if ($date) {
                $data['created_at'] = $date;
                $data['updated_at'] = $date;
            }
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
        $dias = [];
        $bonus = [];

        foreach ($users as $user) {
            // Iterar sobre cada dia do mês até hoje
            for ($date = $startOfMonth->copy(); $date <= $today; $date->addDay()) {
                $currentDate = $date->copy(); // Clonar a data atual
                $dias[] = $currentDate->toDateString(); // Adicionar a data no array de dias

                if ($user->verifyAlredyPayBonusSpecificDay($currentDate)) {
                    $bonus[] = [
                        'user_id' => $user->id,
                        'date' => $currentDate->toDateString(),
                    ];
                    $compensation = new CompensationController();
                    $compensation->dailyCompensation($user->id, $currentDate);
                }
            }
        }

        return response()->json([
            'bonus' => $bonus,
            'dias' => $dias,
        ]);
    }
}

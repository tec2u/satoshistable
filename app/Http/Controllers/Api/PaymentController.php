<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\PaymentLog;
use App\Traits\OrderBonusTrait;
use App\Traits\PaymentLogTrait;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use PaymentLogTrait, OrderBonusTrait;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notify(Request $request)
    {
        $requestFormated = $request->all();

        $payment = OrderPackage::where('id', $requestFormated["id_order"])
            ->where('payment_status', "<>", 1)
            ->first();

        try {

            if (isset($requestFormated["node"])) {

                if (!isset($payment) || $payment->id != $requestFormated["id_order"]) {
                    return false;
                }

                if (
                    strtolower($requestFormated["status"]) == 'paid'
                    || strtolower($requestFormated["status"]) == 'overpaid'
                    || strtolower($requestFormated["status"]) == 'underpaid'
                ) {
                    $payment->payment_status = 1;
                    $payment->status = 1;
                }

                if (strtolower($requestFormated["status"]) == 'cancelled' || strtolower($requestFormated["status"]) == 'expired') {
                    $payment->payment_status = 2;
                    $payment->status = 0;
                }

                $payment->save();

                $log = new PaymentLog;
                $log->content = $requestFormated["status"];
                $log->order_package_id = $payment->id;
                $log->operation = "payment package";
                $log->controller = "packageController";
                $log->http_code = "200";
                $log->route = "/api/notify";
                $log->status = "success";
                $log->json = json_encode($request->all());
                $log->save();

                return response()->json('success');
            }
        } catch (Exception $e) {

            $this->errorPaymentCatch($e->getMessage(), $payment->id);
        }
        return response("OK", 200);
    }
}

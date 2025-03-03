<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderPackage;
use App\Models\Package;
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
    public function notity(Request $request)
    {
        $content = $request->getContent();
        $dados =  json_decode(json_encode($request->all()), false);

        if (!empty($dados)) {
            $codepayment = $dados->merchant_id;
            $status = $dados->status_code;

            $id = "";

            $order = OrderPackage::where('transaction_code', $codepayment)->first();

            if ($order->others_packages_id && $status == 1) {
                try {
                    $otherPackagesIDs = explode(",", $order->others_packages_id);
                    $otherPackages = Package::whereIn('id', $otherPackagesIDs)->get();

                    foreach ($otherPackages as $otherPackage) {
                        OrderPackage::create([
                            "user_id" => $order->user_id,
                            "reference" => $otherPackage->name,
                            "payment_status" => 0,
                            "transaction_code" => 0,
                            "package_id" => $otherPackage->id,
                            "price" => $otherPackage->price,
                            "amount" => 1,
                            "transaction_wallet" => 0,
                            "wallet" => 0,
                            "server" => ''
                        ]);
                    }

                    $order->delete();
                } catch (Exception $e) {

                    $this->errorPaymentCatch($e->getMessage(), $order->id);
                }
            } else {
                try {

                    if (!empty($order)) {
                        $data = [
                            "status" => $status == 1 ? 1 : 0,
                            "payment_status" => $status
                        ];
                        $id = $order->id;
                        $order->update($data);

                        if ($status == 1) {
                            $this->bonus_compra(0, $order->user_id, $order->price, $order->id);
                            $this->createPaymentLog('Payment processed successfully', 200, 'success',  $id, $content);
                        }
                    }
                } catch (Exception $e) {

                    $this->errorPaymentCatch($e->getMessage(), $id);
                }
            }
        }
    }
}

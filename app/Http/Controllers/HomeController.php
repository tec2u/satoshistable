<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\HistoricScore;
use App\Models\Package;
use App\Models\User;
use App\Models\DailyImages;
use App\Models\OrderPackage;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Career;
use App\Models\CareerUser;

class HomeController extends Controller
{
   // /**
   //  * Create a new controller instance.
   //  *
   //  * @return void
   //  */
   // public function __construct()
   // {
   //    $this->middleware('auth');
   // }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      $id_user = Auth::id();
      $packages = OrderPackage::where('user_id', $id_user)->where('payment_status', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
      $orderpackages = OrderPackage::where('user_id', $id_user)->orderBy('id', 'DESC')->limit(5)->get();
      $user = User::where('id', $id_user)->first();
      $current_package = OrderPackage::where('user_id', $id_user)->first();
      $pacote = $user->orderPackage->first();
      $career = CareerUser::where('user_id', $user->id)->max('career_id');
      //dd($career);
      if (isset($career)) {
         $carrer = Career::find($career);
      } else {
         $carrer = Career::find(1);
      }

      $recomendation = User::where('recommendation_user_id', $user->id)->where('activated', 0)->get();

      $inactiverights = count($recomendation);

      if (empty($pacote)) {
         $name = '';
      } else {
         $name = $pacote->reference;
      }

      $from = date('Y-m-d');
      $to = date('Y-m-d', strtotime("-30 days", strtotime($from)));


      $bonususer = Banco::where('user_id', $user->id)
         ->whereIn('description', [1, 2, 4, 5])
         ->where('created_at', '>=', "$to 00:00:00")
         ->where('created_at', '<=', "$from 23:59:59")
         ->selectRaw('sum(price) as total')
         ->first();

      if (empty($bonususer)) {
         $totalbanco = 0;
      } else {
         $totalbanco = $bonususer->total;
      }

      $bonusdaily = Banco::where('user_id', $user->id)
         ->whereIn('description', [6])
         ->where('created_at', '>=', "$to 00:00:00")
         ->where('created_at', '<=', "$from 23:59:59")
         ->groupBy('user_id')
         ->selectRaw('sum(price) as total, user_id')
         ->first();

      if (empty($bonusdaily)) {
         $bonusdaily = 0;
      } else {
         $bonusdaily = $bonusdaily->total;
      }

      $pontos = HistoricScore::where('user_id', $user->id)
         ->where('created_at', '>=', "$to 00:00:00")
         ->where('created_at', '<=', "$from 23:59:59")
         ->selectRaw('sum(score) as total')
         ->first();

      if (empty($pontos)) {
         $pontos = 0;
      } else {
         $pontos = $pontos->total;
      }

      $data = array();
      $datasaida = array();
      $label = array();

      $from = date('Y-m-d');
      $toinicio = date('Y-m-d', strtotime("-30 days", strtotime($from)));
      $saque = 0;
      for ($i = 1; $i < 31; $i++) {

         $to = date('Y-m-d', strtotime("+$i days", strtotime($toinicio)));
         $bonususer = Banco::where('user_id', $user->id)
            ->whereIn('description', [1, 2, 4, 5])
            ->where('created_at', '>=', "$to 00:00:00")
            ->where('created_at', '<=', "$to 23:59:59")
            ->groupBy('created_at')
            ->selectRaw('sum(price) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as created_at')
            ->orderby('created_at')
            ->first();

         $bonussaida = Banco::where('user_id', $user->id)
            ->where('created_at', '>=', "$to 00:00:00")
            ->where('created_at', '<=', "$to 23:59:59")
            ->where('description', '=', 99)
            ->groupBy('created_at')
            ->selectRaw('sum(price) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as created_at')
            ->orderby('created_at')
            ->first();

         if (empty($bonususer)) {
            $total = 0;
         } else {
            $total = $bonususer->total;
         }

         if (empty($bonussaida)) {
            $totalsaida = 0;
         } else {
            $totalsaida = abs($bonussaida->total);
         }

         $saque += $totalsaida;

         $labelbonus = array(
            date('m-d-Y', strtotime($to))
         );

         $databonus = array(
            $total
         );

         $databonussaida = array(
            $totalsaida
         );

         $data = array_merge($data, $databonus);
         $datasaida = array_merge($datasaida, $databonussaida);
         $label = array_merge($labelbonus, $label);
      }
      $datasaida = json_encode($datasaida);
      $label = json_encode(array_reverse($label));
      $data = json_encode($data);

      Alert::html(__('backoffice_alert.home_welcome') . " " . $user->login . "!",
        '<video width="100%" controls>
            <source src="/videos/popup-video.mp4" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
        </video>',
        'success')->persistent(true, 'Fechar');

      $url_image_popup = asset('/images/logo_tiger.jpeg');

      $n_pago = false;
      foreach ($orderpackages as $order) {
         if ($order->payment_status == 0) {
            $n_pago = true;
         }
      }


      return view('home', compact('n_pago', 'packages', 'orderpackages', 'name', 'user', 'data', 'label', 'datasaida', 'totalbanco', 'bonusdaily', 'pontos', 'saque', 'carrer', 'inactiverights', 'url_image_popup'));
   }

   public function welcome1()
   {
      return view('welcome.home');
   }
   public function generic()
   {
      return view('welcome.generic');
   }
   public function elements()
   {
      return view('welcome.elements');
   }

   public function fees()
   {
      $packages = Package::where('type', 'packages')->where('activated', 1)->orderBy('price')->get();
      return view('welcome.fees', compact('packages'));
   }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'login',
        'cpf',
        'password',
        'recommendation_id',
        'telephone',
        'cell',
        'gender',
        'accept_terms',
        'accept_date',
        'country',
        'image_path',
        'financial_password',
        'active_network',
        'active_date',
        'rule',
        'recommendation_user_id',
        'number_residence',
        'complement',
        'area_residence',
        'ban',
        'last_name',
        'address1',
        'address2',
        'postcode',
        'state',
        'city',
        'birthday',
        'special_comission',
        'special_comission_active',
        'id_card',
        'activated',
        'country_code_cel',
        'country_code_fone',
        'qty',
        'contact_id',
        'validate_code',
        'occupation',
        'relationship_status',
        'rfc',
        'etapa'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'financial_password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relacionamento tabelas
     */
    #region relacionamento

    public function consults()
    {
        return $this->hasMany(Consult::class, 'user_id');
    }

    public function recommendation()
    {
        return $this->hasMany(User::class);
    }

    public function leilao()
    {
        return $this->hasMany(Leilao::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function orderPackage()
    {
        return $this->hasMany(OrderPackage::class);
    }

    public function withdraw()
    {
        return $this->hasMany(WithdrawRequest::class);
    }

    public function rede()
    {
        return $this->hasMany(Rede::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    public function banco()
    {
        return $this->hasMany(Banco::class);
    }

    public function score()
    {
        return $this->hasMany(HistoricScore::class);
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }

    public function apples()
    {
        return $this->hasOne(Apple::class, 'user_id', 'id');
    }

    public function career_user()
    {
        return $this->hasMany(CareerUser::class);
    }

    public function config_bonus()
    {
        return $this->hasMany(ConfigBonus::class);
    }
    #endregion

    public function getTotalAttribute()
    {
        $orderItems = $this->orderPackage()->where("status", 1)->where("payment_status", 1)->get();

        $total = 0;
        foreach ($orderItems as $item) {
            $total += ($item->price * $item->amount);
        }
        return $total;
    }

    public function getSponser($param)
    {
        $sponser = User::where('id', $this->recommendation_user_id)->first();
        if (isset($sponser)) {
            return $sponser->$param;
        }
        return '';
    }

    public function getTotalBanco()
    {
        $bancoItems = $this->banco()->get();

        $total = 0;
        $saque = 0;
        $saldo = 0;

        foreach ($bancoItems as $item) {

            if ($item->status == 2) {
                $saque += $item->price;
            }

            if ($item->status == 1) {
                $saldo += $item->price;
            }
        }

        $calcule = $saldo - $saque;

        if ($calcule > 0) {
            $total = $saldo - $saque;
        } else {
            $total = 0;
        }

        return $total;
    }

    public function getComissionAvailable()
    {
        $currentDate = Carbon::now();
        $dayThreshold = 15;
        $subMonth = $currentDate->subMonth()->month;
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;

        if ($subMonth >= 2) {
            $subMonth = $subMonth - 1;
        } else {
            $subMonth = 12;
            $currentYear = $currentYear - 1;
        }

        if ($subMonth < 9) {
            $subMonth = '0' . $subMonth;
        }


        if ($currentDate->day >= $dayThreshold) {

            $availableComission = DB::table('banco')
                ->where('user_id', $this->id)
                ->where('price', '>', 0)
                ->sum('price');
        } else {
            $availableComission = DB::table('banco')
                ->where('user_id', $this->id)
                ->where('price', '>', 0)
                ->sum('price');
        }

        $retiradasTotais = DB::table('banco')
            ->where('user_id', $this->id)
            ->where('price', '<', 0)
            ->sum('price');

        $retiradasTotais = -$retiradasTotais;

        if ($retiradasTotais >= $availableComission) {
            $availableComission = 0;
        } else {
            $availableComission = $availableComission - $retiradasTotais;
        }

        return $availableComission;
    }

    public function getTotalBancoComissao()
    {
        $bancoItems = $this->banco()->get();

        $total = 0;
        foreach ($bancoItems as $item) {
            $total += $item->price;
        }
        return $total;
    }

    public function getTotalBancoCurrent()
    {
        $bancoItems = $this->banco()->where('description', 3)->get();

        $total = 0;
        foreach ($bancoItems as $item) {
            $total += $item->price;
        }

        $bancoItems = $this->banco()->where('description', 99)->where('description', 98)->get();

        $saque = 0;
        foreach ($bancoItems as $item) {
            $saque += $item->price;
        }
        $total = $total + $saque;
        return $total;
    }

    public function getTotalBancoIndicacao()
    {
        $bancoItems = $this->banco()->where('description', 1)->get();

        $total = 0;
        foreach ($bancoItems as $item) {
            $total += $item->price;
        }
        return $total;
    }

    public function getTotalBancoIndicacaoDirectIndirect()
    {
        $bancoItems1 = $this->banco()->where('description', 1)->get();

        $total = 0;
        foreach ($bancoItems1 as $item) {
            $total += $item->price;
        }

        $bancoItems2 = $this->banco()->where('description', 2)->get();

        foreach ($bancoItems2 as $item) {
            $total += $item->price;
        }

        return $total;
    }



    public function getTotalBancoDirect()
    {
        $bancoItems = $this->banco()->where('description', 7)->where('description', 8)->get();

        $total = 0;
        foreach ($bancoItems as $item) {
            $total += $item->price;
        }
        return $total;
    }

    public function getTotalBancoILevel()
    {
        $bancoItems = $this->banco()->where('description', 2)->get();

        $total = 0;
        foreach ($bancoItems as $item) {
            $total += $item->price;
        }
        return $total;
    }

    public function getTotalBancoPool()
    {
        $bancoItems = $this->banco()->where('description', 5)->get();

        $total = 0;
        foreach ($bancoItems as $item) {
            $total += $item->price;
        }
        return $total;
    }

    public function getTotalBancoDaily()
    {
        $bancoItems = $this->banco()->where('description', 3)->get();

        $total = 0;
        foreach ($bancoItems as $item) {
            $total += $item->price;
        }
        return $total;
    }

    public function getDirects($id)
    {
        $direct = User::where('recommendation_user_id', $id)->get()->count();
        return $direct;
    }

    public function getDirectsWithOrders($id)
    {
        $direct = DB::table('orders_package')
            ->join('users', 'orders_package.user_id', 'users.id')
            ->where("recommendation_user_id", $id)
            ->where("status", 1)
            ->where("payment_status", 1)
            ->count(DB::raw('DISTINCT user_id'));

        return $direct;
    }

    public function getDirectsActiveted($id)
    {
        $direct = User::where('recommendation_user_id', $id)->get()->count();
        return $direct;
    }

    public function getCards($id)
    {
        $cards = DB::table('orders_package')
            ->join('users', 'orders_package.user_id', 'users.id')
            ->where('user_id', $id)
            ->where("status", 1)
            ->where("payment_status", 1)
            ->count(DB::raw('user_id'));

        return $cards;
    }

    public function getTeam($id)
    {
        $team = HistoricScore::where('user_id', $id)->distinct()->get(['user_id_from'])->count();
        return $team;
    }

    public function getVolume($id)
    {
        $rede_raiz = MatrizForcada::where('id_dados',$id )->first();

        if (!empty($rede_raiz)) {
            $rede = DB::select(
                "WITH RECURSIVE downline AS (
                    SELECT id, id_dados, upline, ciclo, qty, 1 AS level
                    FROM matriz_forcada3x10
                    WHERE upline = " .
                    $rede_raiz->id .
                    "

                    UNION ALL

                SELECT u.id, u.id_dados, u.upline, u.ciclo, u.qty, d.level + 1
                FROM matriz_forcada3x10 u
                INNER JOIN downline d ON u.upline = d.id
                WHERE d.level < 6
            )
            SELECT
                COUNT(CASE WHEN u.id IS NOT NULL THEN 1 END) AS direct_count,
                COUNT(CASE WHEN u.id IS NULL THEN 1 END) AS indirect_count
            FROM downline d
            LEFT JOIN users u ON u.id = d.id_dados AND u.recommendation_user_id = " .
                    $rede_raiz->id_dados .
                    '',
            );
        }

        $diretos = isset($rede[0]->{'direct_count'}) ? $rede[0]->{'direct_count'} : 0;
        $indiretos = isset($rede[0]->{'indirect_count'}) ? $rede[0]->{'indirect_count'} : 0;

        $totalMembros = $diretos + $indiretos;
        return $totalMembros;
    }

    public function getPoll($id)
    {
        $poll = HistoricScore::where('user_id', $id)->where('description', "9")->selectRaw('sum(score) as total')
            ->first();

        if (empty($poll->total)) {
            $poll->total = 0;
        }

        return $poll->total;
    }

    public function getRede($id)
    {
        $rede = HistoricScore::where('user_id', $id)->where('score', "0")->where('description', "Contador")->selectRaw('count(*) as total')
            ->first();

        if (empty($rede->total)) {
            $rede->total = 0;
        }

        return $rede->total;
    }

    public function getAdessao($id)
    {
        $count = DB::table('orders_package')
            ->join('packages', 'orders_package.package_id', '=', 'packages.id')
            ->where('user_id', $id)
            ->where('payment_status', 1)
            ->where('type', 'activator')
            ->where('status', 1)
            ->count();

        return $count;
    }

    public function getPackages($id)
    {
        $count = DB::table('orders_package')
            ->join('packages', 'orders_package.package_id', '=', 'packages.id')
            ->where('user_id', $id)
            ->where('payment_status', 1)
            ->where('type', 'packages')
            ->where('status', 1)
            ->count();

        return $count;
    }

    public function isAllowed()
    {
        $is_allowed = DB::table('system_conf')->first();

        if ($is_allowed != null && $is_allowed->is_allowed_btn_box) {
            return true;
        } else {
            return false;
        }

        return false;
    }

    public function isActive()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $user = $user = User::where('id', $this->id)->first();
        $orderPackageExists = OrderPackage::where('user_id', $this->id)->where('status', 1)->where('payment_status', 1)->where('created_at', '>=', $thirtyDaysAgo);
        if ($user->activated) {
            return true;
        } else {
            return false;
        }
    }

    public function orderPackages()
    {
        return $this->hasMany(OrderPackage::class);
    }

    public function hasValidOrderPackage($startDate, $endDate)
    {
        return $this->orderPackages()
            ->where('status', 1)
            ->where('payment_status', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->exists();
    }

    public function getValidOrderPackage($startDate, $endDate)
    {
        return $this->orderPackages()
            ->where('status', 1)
            ->where('payment_status', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('package')->first();
    }

    public function scopeHasValidOrdersPackage($query, $startDate, $endDate)
    {
        return $query->whereHas('orderPackages', function ($query) use ($startDate, $endDate) {
            $query->where('status', 1)
                ->where('payment_status', 1)
                ->whereBetween('created_at', [$startDate, $endDate]);
        });
    }

    public function scopeDoesntHaveValidOrdersPackage($query, $startDate, $endDate)
    {
        return $query->whereDoesntHave('orderPackages', function ($query) use ($startDate, $endDate) {
            $query->where('status', 1)
                ->where('payment_status', 1)
                ->whereBetween('created_at', [$startDate, $endDate]);
        });
    }

    public function payFirstOrder()
    {
        $pay = OrderPackage::where('user_id', $this->id)->where('status', 1)->where('payment_status', 1)->first();

        if ($pay != null) {
            return true;
        } else {
            return false;
        }

        return false;
    }

    public function isActivedUser($user_id)
    {
        $OpenMenuOrders = OrderPackage::where('user_id', $user_id)
            ->where('status', 1)
            ->where('payment_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        $OpenMenu = 0;
        $menuLimited = 0;
        $onlyPackages = 0;

        if ($OpenMenuOrders->isNotEmpty()) {
            foreach ($OpenMenuOrders as $order) {
                $monthly_validity = $order->package->monthly_validity ?? 1;
                $dtPayed = Carbon::parse($order->updated_at);
                $expirationDate = $dtPayed->copy()->addMonths($monthly_validity)->addDays(15);

                if (Carbon::now()->lessThanOrEqualTo($expirationDate)) {
                    // Pedido está no prazo
                    $OpenMenu = 1;
                    $menuLimited = $order->package->limited;
                    $onlyPackages = 0;
                    break; // Parar o loop assim que encontrar o primeiro pedido válido
                }
            }

            if ($OpenMenu === 0) {
                // Se nenhum pedido válido foi encontrado e ainda temos pedidos, então eles estão expirados
                $onlyPackages = 1;
            }
        } else {
            // Não há pedidos
            $OpenMenu = 0;
            $menuLimited = 0;
            $onlyPackages = 0;
        }

        return [
            'OpenMenu' => $OpenMenu,
            'OnlyPackages' => $onlyPackages,
            'MenuLimited' => $menuLimited,
        ];
    }

    public function temPackagePago($id)
    {
        $pacotes = OrderPackage::where('user_id', $id)
            ->where('status', 1)
            ->where('payment_status', 1)
            ->orderBy('id', 'desc')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        return count($pacotes) > 0 ? true : false;
    }

    public function getTypeActivated($id)
    {

        $pay = OrderPackage::where('user_id', $id)->where('status', 1)->where('payment_status', 1)->first();

        $getadessao = $this->getAdessao($id);

        $getpackages = $this->getPackages($id);

        if (!$pay) {
            $tag = "Inactive";
        }
        if ($getadessao > 0) {
            $tag = "PreRegistration";
        }
        if ($getpackages > 0) {
            $tag = "AllCards";
        }

        return $tag;
    }

    public function getRedeAdessao($id)
    {
        $count = DB::table('orders_package')
            ->join('users', 'orders_package.user_id', 'users.id')
            ->join('packages', 'orders_package.package_id', '=', 'packages.id')
            ->where("recommendation_user_id", $id)
            ->where('type', 'activator')
            ->where("status", 1)
            ->where("payment_status", 1)
            ->count(DB::raw('DISTINCT user_id'));
        return $count;
    }

    public function getRedePackages($id)
    {
        $count =
            DB::table('orders_package')
                ->join('users', 'orders_package.user_id', 'users.id')
                ->join('packages', 'orders_package.package_id', '=', 'packages.id')
                ->where("recommendation_user_id", $id)
                ->where('type', 'packages')
                ->where("status", 1)
                ->where("payment_status", 1)
                ->count(DB::raw('DISTINCT user_id'));
        return $count;
    }
}

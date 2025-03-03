<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderPackage extends Model
{
    use HasFactory;

    protected $table = 'orders_package';

    protected $fillable = [
        'id',
        'user_id',
        'reference',
        'payment_status',
        'transaction_code',
        'transaction_wallet',
        'package_id',
        'price',
        'amount',
        'status',
        'activated',
        'wallet',
        'hide',
        'subscription_id',
        'date_save',
        'id_transaction_banks',
        'activator_id',
        'others_packages_id'
    ];

    /**
     * Relacionamentos de Tabelas
     */
    #region relacionamento
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }

    public function transactionBank()
    {
        return $this->belongsTo(TransactionBank::class, 'id_transaction_banks');
    }
    #endregion
}

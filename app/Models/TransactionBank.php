<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBank extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'activated', 'name', 'logo'];

    public function orderPackages()
    {
        return $this->hasMany(OrderPackage::class, 'id_transaction_banks');
    }
}

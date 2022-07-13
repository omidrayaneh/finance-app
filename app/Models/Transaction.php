<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public static function generateTransactonCUST()
    {
        $number = mt_rand(1000, 9999999999);
        if (Transaction::checkTransactonCUST($number)) {
            return Transaction::generateTransactonCUST();
        }
        return (string)$number;
    }
    public static function checkTransactonCUST($number)
    {
        return Transaction::where('cust_id',$number)->exists();
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public static function generateAccountNo()
    {
        $number = mt_rand(1000, 9999999999);
        if (Account::checkAccountNo($number)) {
            return Account::generateAccountNo();
        }
        return (string)$number;
    }
    public static function checkAccountNo($number)
    {
        return Account::where('account_no',$number)->exists();
    }


}

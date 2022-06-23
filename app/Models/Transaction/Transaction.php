<?php

namespace App\Models\Transaction;

use App\Models\Customer\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    // use SoftDeletes;


    public $total;

    protected $table = 'transactions';

    protected $fillable = [
        'customer_id',
        'transaction_amount',
        'paid_to',
    ];


    public function User()
    {
        return $this->hasOne(User::class,'id','paid_to');
    }

    public function Customer()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}

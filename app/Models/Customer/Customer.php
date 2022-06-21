<?php

namespace App\Models\Customer;

use App\Models\Agent\Agent;
use App\Models\Collection\Collection;
use App\Models\Location\Location;
use App\Models\Plan\Plan;
use App\Models\Scheme\Scheme;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    // use SoftDeletes;


    protected $table = 'customers';


    protected $fillable = [
        'customer_id',
        'f_username',
        's_username',
        'primary_phone',
        'secondary_phone',
        'location_id',
        'plan_id',
        'refered_agent_id',
        'scheme_id',
        'complement_one',
        'complement_two',
    ];



    public function Collection()
    {
        return $this->hasOne(Collection::class, 'customer_id', 'id');
    }

    public function Location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function Plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }

    public function Agent()
    {
        return $this->hasOne(Agent::class, 'id', 'refered_agent_id');
    }

    public function Scheme()
    {
        return $this->hasOne(Scheme::class, 'id', 'scheme_id');
    }


    public function Transaction()
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'id');
    }
}

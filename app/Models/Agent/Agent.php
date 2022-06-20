<?php

namespace App\Models\Agent;

use App\Models\Location\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table='agents';


    protected $fillable=[
        'agent_id',
        'agent_name',
        'agent_phone',
        'agent_location_id',
    ];


    public function Location()
    {

        return $this->hasOne(Location::class,'id','agent_location_id');
    }
}

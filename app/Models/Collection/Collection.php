<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table='collections';


    protected $fillable=[
        'customer_id',
        'plan_id',
        'collection_total_due',
        'collection_balance_due',
    ];
}

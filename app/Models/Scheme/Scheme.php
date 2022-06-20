<?php

namespace App\Models\Scheme;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scheme extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table='schemes';


    protected $fillable=[
        'scheme_name',
        'scheme_start_date',
        'scheme_end_date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    
    protected $fillable = [
        'merk',
        'model',
        'engine_size',
        'cylinders',
        'fuel_consumption_comb',
        'fuel_consumption_mpg',
        'co2_emissions'
    ];

    protected $casts = [
        'engine_size' => 'decimal:1',
        'fuel_consumption_comb' => 'decimal:1',
        'fuel_consumption_mpg' => 'decimal:1',
        'cylinders' => 'integer',
        'co2_emissions' => 'integer'
    ];
}
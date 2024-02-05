<?php

namespace App\Models;

use App\Query\HotelBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages'
    ];

    public function newEloquentBuilder($query): HotelBuilder
    {
        return new HotelBuilder($query);
    }
}
